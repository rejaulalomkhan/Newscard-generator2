<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if (!isset($_GET['url'])) {
    echo json_encode(['error' => 'URL parameter is required']);
    exit;
}

$url = filter_var($_GET['url'], FILTER_VALIDATE_URL);
if (!$url) {
    echo json_encode(['error' => 'Invalid URL format']);
    exit;
}

// Fetch the page with cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo json_encode(['error' => 'Failed to fetch: ' . $error]);
    exit;
}

if ($httpCode !== 200 || !$html) {
    echo json_encode(['error' => 'HTTP Error: ' . $httpCode]);
    exit;
}

// Parse HTML with DOMDocument
$doc = new DOMDocument();
libxml_use_internal_errors(true); // Suppress warnings
@$doc->loadHTML('<?xml encoding="UTF-8">' . $html);
libxml_clear_errors();
$xpath = new DOMXPath($doc);

// Extract title - multiple sources
$title = '';
$titleSources = [
    '//meta[@property="og:title"]/@content',
    '//meta[@name="twitter:title"]/@content',
    '//meta[@name="title"]/@content',
    '//meta[@itemprop="name"]/@content',
    '//h1[1]',
    '//title'
];

foreach ($titleSources as $source) {
    $result = $xpath->query($source);
    if ($result && $result->length > 0) {
        $title = trim($result->item(0)->nodeValue);
        if (!empty($title) && strlen($title) > 3) break;
    }
}

// Clean title
$title = html_entity_decode($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
$title = preg_replace('/\s+/', ' ', $title);
$title = trim($title);

// Remove common suffixes
$patterns = [
    '/\s*[-|::]\s*[^-|::]+$/',  // Remove " - Site Name" or " | Site Name"
];
foreach ($patterns as $pattern) {
    $cleaned = preg_replace($pattern, '', $title, 1);
    if (strlen($cleaned) > 10) {
        $title = $cleaned;
        break;
    }
}

// Extract image - multiple sources
$image = '';
$imageSources = [
    '//meta[@property="og:image"]/@content',
    '//meta[@property="og:image:url"]/@content',
    '//meta[@property="og:image:secure_url"]/@content',
    '//meta[@name="twitter:image"]/@content',
    '//meta[@name="twitter:image:src"]/@content',
    '//meta[@itemprop="image"]/@content',
    '//link[@rel="image_src"]/@href',
    '//article//img[1]/@src',
    '//img[contains(@class, "featured")]/@src',
    '//img[contains(@class, "wp-post-image")]/@src',
    '//img[@width > 400][1]/@src',
    '//img[string-length(@alt) > 10][1]/@src'
];

foreach ($imageSources as $source) {
    $result = $xpath->query($source);
    if ($result && $result->length > 0) {
        $img_url = trim($result->item(0)->nodeValue);
        if (!empty($img_url)) {
            // Skip tiny images and placeholders
            if (stripos($img_url, 'pixel') === false && 
                stripos($img_url, 'placeholder') === false &&
                stripos($img_url, '1x1') === false) {
                $image = $img_url;
                break;
            }
        }
    }
}

// Make image URL absolute
if ($image && !preg_match('/^https?:\/\//i', $image)) {
    $parsed = parse_url($url);
    $base = $parsed['scheme'] . '://' . $parsed['host'];
    
    if ($image[0] === '/') {
        $image = $base . $image;
    } else {
        $path = isset($parsed['path']) ? dirname($parsed['path']) : '';
        $image = $base . $path . '/' . $image;
    }
}

// Validate final image URL
if ($image && !filter_var($image, FILTER_VALIDATE_URL)) {
    $image = '';
}

// Extract description
$description = '';
$descSources = [
    '//meta[@property="og:description"]/@content',
    '//meta[@name="twitter:description"]/@content',
    '//meta[@name="description"]/@content',
    '//meta[@itemprop="description"]/@content'
];

foreach ($descSources as $source) {
    $result = $xpath->query($source);
    if ($result && $result->length > 0) {
        $description = trim($result->item(0)->nodeValue);
        if (!empty($description)) break;
    }
}

$description = html_entity_decode($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
$description = preg_replace('/\s+/', ' ', $description);

// Get site name
$siteName = '';
$siteNameSources = [
    '//meta[@property="og:site_name"]/@content',
    '//meta[@name="application-name"]/@content'
];

foreach ($siteNameSources as $source) {
    $result = $xpath->query($source);
    if ($result && $result->length > 0) {
        $siteName = trim($result->item(0)->nodeValue);
        if (!empty($siteName)) break;
    }
}

if (empty($siteName)) {
    $parsed = parse_url($url);
    $siteName = isset($parsed['host']) ? $parsed['host'] : '';
    $siteName = preg_replace('/^www\./', '', $siteName);
}

// Return JSON response
echo json_encode([
    'success' => true,
    'title' => $title,
    'image' => $image,
    'description' => $description,
    'siteName' => $siteName,
    'url' => $url
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

