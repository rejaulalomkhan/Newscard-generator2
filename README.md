# Newscard Generator 2.0

🎨 A powerful web-based tool for creating stunning newscard graphics and social media visuals. Designed specifically for news websites, journalists, bloggers, and content creators who need professional-quality graphics in seconds.

![Newscard Generator Preview](./preview.png)

## ✨ Features

- **🎭 Multiple Professional Templates**: Choose from 12+ beautifully designed templates including Classic Newspaper, Jamuna, Prothom Alo, Kaler Kantho, and more
- **🌐 Bengali Language Support**: Full support for Bengali text with proper fonts and typography rendering
- **✍️ Customizable Content**: Edit headings, subheadings, dates, captions, and all text elements
- **🖼️ Advanced Image Integration**: Upload images or use URLs with powerful controls:
  - Image scaling and positioning
  - Object-fit options (cover, contain, fill)
  - Real-time preview adjustments
- **🎨 Complete Design Control**:
  - Custom accent colors
  - Background color customization
  - Text color adjustments
  - 20+ Google Fonts including Bengali fonts
- **🌙 Dark/Light Theme**: Built-in theme toggle for comfortable editing in any lighting
- **⚡ URL Fetching**: Automatically fetch title and image from any news URL
- **📤 Export Options**: 
  - Generate high-quality 1080x1080 PNG images
  - Export/Import JSON configurations
- **📱 Fully Responsive**: Works seamlessly on desktop, tablet, and mobile devices
- **💾 Auto-Save**: Automatically saves your work and preferences using local storage

## 🛠️ Technologies Used

- **HTML5**: Modern semantic markup and structure
- **CSS3**: Custom properties, flexbox, grid, and fully responsive design
- **Vanilla JavaScript**: Zero dependencies for core functionality, pure JavaScript for optimal performance
- **html2canvas**: Advanced client-side image generation from HTML
- **Choices.js**: Enhanced searchable select dropdowns
- **Google Fonts**: 20+ font families including Bengali-specific fonts

## 🚀 Quick Start

### Local Setup
1. Clone this repository:
   ```bash
   git clone https://github.com/rejaulalomkhan/Newscard-generator2.git
   cd Newscard-generator2
   ```

2. Open `index.html` in your web browser:
   ```bash
   # Simply open the file
   open index.html
   
   # Or use a local server (recommended):
   python -m http.server 8000
   # Then visit http://localhost:8000
   
   # Or with Node.js:
   npx serve
   ```

That's it! No build process, no dependencies to install. Just open and start creating.

## 📖 How to Use

1. **Select a Template** 🎭
   - Browse through 12+ professional templates in the sidebar
   - Read the template description to find the perfect style

2. **Fetch Content (Optional)** 🔗
   - Paste any news article URL
   - Click "Fetch Title & Image" to auto-populate content

3. **Customize Content** ✍️
   - Edit heading, subheading, date, caption
   - Add your domain name and social media handles
   - All changes appear in real-time

4. **Upload Images** 🖼️
   - Upload from your device OR paste an image URL
   - Fine-tune with scale slider
   - Adjust position with X/Y controls
   - Choose object-fit mode

5. **Style Your Card** 🎨
   - Select from 20+ Google Fonts
   - Pick accent, background, and text colors
   - Upload custom logo
   - Add advertisement images (template-dependent)

6. **Export** 💾
   - Click "Download Image" for PNG (1080x1080)
   - Use "Export JSON" to save your configuration
   - Use "Import JSON" to restore saved configurations

## 📋 Available Templates

| Template | Style | Best For |
|----------|-------|----------|
| **Classic Newspaper** | Traditional layout with large image | General news, Breaking stories |
| **Jamuna** | Modern overlay text design | Social media posts |
| **Prothom Alo** | Professional newspaper style | Editorial content |
| **Kaler Kantho** | Clean, minimalist design | Business news |
| **Samakal** | Bold typography | Headlines, Announcements |
| **Bangladesh Pratidin** | Structured grid layout | Feature stories |
| **Ittefaq** | Classic newspaper format | Traditional news |
| **Manab Zamin** | Traditional styling | Cultural content |
| **Amar Desh** | Bold and prominent | Breaking news |
| **Naya Diganta** | Elegant design | Opinion pieces |
| **Jugantor** | Dynamic layout | Sports, Entertainment |
| **Inqilab** | Impactful presentation | Political news |

## 🌐 Browser Support

| Browser | Minimum Version |
|---------|-----------------|
| Chrome | 70+ ✅ |
| Firefox | 65+ ✅ |
| Safari | 12+ ✅ |
| Edge | 79+ ✅ |
| Opera | 57+ ✅ |

## 🤝 Contributing

We welcome contributions from the community! Here's how you can help:

### General Contributions
1. 🍴 Fork the repository
2. 🌿 Create your feature branch: `git checkout -b feature/AmazingFeature`
3. 💾 Commit your changes: `git commit -m 'Add some AmazingFeature'`
4. 📤 Push to the branch: `git push origin feature/AmazingFeature`
5. 🎉 Open a Pull Request

### Adding New Templates
Want to add a custom template? Follow these steps:

1. Open `templates.js`
2. Add a new template object to the `templates` array with:
   - `id`: Unique identifier (string)
   - `name`: Display name (string)
   - `description`: Brief description (string)
   - `defaults`: Default values for all fields (object)
   - `html`: Template HTML structure (string)
   - `css`: Template-specific styles (string)
3. Use template variables in curly braces: `{heading}`, `{image}`, `{date}`, etc.
4. Test thoroughly with different content and images
5. Submit a pull request with screenshots

### Report Bugs
Found a bug? Please open an issue with:
- Clear title and description
- Steps to reproduce
- Expected vs actual behavior
- Screenshots if applicable

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for complete details.

## 👨‍💻 Developer

**Arman azij**
- 👤 Facebook: [@armanaazij](https://fb.com/armanaazij)
- 💻 GitHub: [@rejaulalomkhan](https://github.com/rejaulalomkhan)
- 🔗 Repository: [Newscard-generator2](https://github.com/rejaulalomkhan/Newscard-generator2)

## 🙏 Acknowledgments

- 🎨 Icons from [Lucide](https://lucide.dev/) & [Heroicons](https://heroicons.com/)
- 🔤 Fonts from [Google Fonts](https://fonts.google.com/)
- 💡 UI/UX inspired by modern design principles
- 🌟 Special thanks to the open-source community

## 💬 Support

If you find this tool helpful, please:
- ⭐ Star this repository
- 🐛 Report bugs via GitHub Issues
- 💡 Suggest new features
- 📢 Share with fellow content creators

---

<div align="center">

### Made with ❤️ for journalists and content creators worldwide

**[Get Started Now](https://github.com/rejaulalomkhan/Newscard-generator2)** | **[Report Bug](https://github.com/rejaulalomkhan/Newscard-generator2/issues)** | **[Request Feature](https://github.com/rejaulalomkhan/Newscard-generator2/issues)**

</div>