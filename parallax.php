<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page</title>
</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

  * {
    font-family: Poppins, "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html {
    scroll-behavior: smooth;
  }

  body {
    background: #eff5f5;
    min-height: 100vh;
    overflow-x: hidden;
  }

  header {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 50px 200px;
    display: flex;
    justify-content: end;
    align-items: center;
    z-index: 100;
  }

  .navigation a,
  .getStartedDiv a {
    text-decoration: none;
    color: white;
    background-color: darkblue;
    padding: 8px 25px 10px 25px;
    border-radius: 20px;
    margin: 0 10px;
    font-weight: 600;
  }

  .navigation a:hover,
  .getStartedDiv a:hover {
    background-color: rgb(54, 54, 146);
  }

  .parallax {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;

    img {
      position: absolute;
      top: 0;
      left: 0;
      pointer-events: none;
      -webkit-filter: drop-shadow(1px 1px 5px #000000);
      filter: drop-shadow(5px 5px 5px #0000002f);
    }
  }

  #logo {
    width: 500px;
    top: 40%;
    left: 35%;
  }

  #doc {
    width: 400px;
    top: 2%;
    left: 80%;
  }

  #pdf {
    width: 270px;
    top: 55%;
    left: 85%;
  }

  #warning {
    width: 70px;
    top: 7%;
    left: 62%;
  }

  #mp3 {
    width: 100px;
    top: 5%;
    left: 35%;
  }

  #jpg {
    width: 70px;
    top: 80%;
    left: 65%;
  }

  #search {
    width: 100px;
    top: 80%;
    left: 27%;
  }

  #folder {
    width: 300px;
    top: 52%;
    left: -2%;
  }

  #ppt {
    width: 400px;
    top: 0%;
    left: -2%;
  }

  /* Intro section styling */
.intro {
  max-width: 1200px;
  margin: 50px auto;
  padding: 40px;
  background-color: white;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.intro h1 {
  font-size: 36px;
  color: #2c3e50;
  margin-bottom: 20px;
  text-align: center;
}

.intro h2 {
  font-size: 28px;
  color: #34495e;
  margin-top: 20px;
  text-align: center;
  margin-bottom: 20px;
}

.intro p {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 20px;
  color: #555;
}

.intro ul {
  list-style-type: none;
  margin-top: 20px;
  margin-bottom: 40px;
}

.intro ul li {
  font-size: 16px;
  margin-bottom: 10px;
  padding-left: 20px;
  position: relative;
}

.intro ul li::before {
  content: "•";
  color: #2c3e50;
  position: absolute;
  left: 0;
  top: 0;
}

.getStartedDiv {
  text-align: center;
  margin-top: 40px;
}

.getStartedDiv a {
  padding: 12px 30px;
  background-color: #2c3e50;
  color: white;
  text-decoration: none;
  font-size: 18px;
  border-radius: 5px;
}

.getStartedDiv a:hover {
  background-color: #34495e;
}
</style>

<body>
  <header>
    <nav class="navigation">
      <a href="index.php">Sign in</a>
      <a href="adminSignUp.php">Sign up</a>
    </nav>
  </header>

  <section class="parallax">
    <img src="img/logo.png" id="logo" />
    <img src="img/warning.png" id="warning" />
    <img src="img/mp3.png" id="mp3" />
    <img src="img/search.png" id="search" />
    <img src="img/jpg.png" id="jpg" />
    <img src="img/ppt.png" id="ppt" />
    <img src="img/folder.png" id="folder" />
    <img src="img/doc.png" id="doc" />
    <img src="img/pdf.png" id="pdf" />
  </section>
  <section class="intro">
    <h1>Welcome to FileFlex</h1>
    <h2>Your Ultimate File Management Solution</h2>
    <p>
      In today’s fast-paced digital world, managing files has become an essential yet complex task. Whether you’re a student, a professional, a business, or simply someone who needs to organize and access their files efficiently, FileFlex is here to revolutionize the way you handle your digital data. With FileFlex, we’ve redefined file management to provide you with a seamless, secure, and intuitive platform designed for users of all types.
    </p>
    <br />
    <h2>What is FileFlex?</h2>
    <p>
      FileFlex is an advanced file management system that offers you a powerful and user-friendly interface for organizing, storing, and accessing your files across multiple devices. Built to be simple yet feature-rich, FileFlex provides everything you need to keep your documents, images, videos, and other digital files in order. From individuals needing to store personal files to businesses requiring collaborative document management, FileFlex is your go-to solution for comprehensive file organization.
    </p>
    <br />
    <h2>Why Choose FileFlex?</h2>
    <ul>
      <li><strong>Unified File Storage:</strong> With FileFlex, all your files are stored in one place, making it easier than ever to access, share, and manage your data. Gone are the days of scattered files across devices and platforms.</li>
      <li><strong>Cloud Sync:</strong> Take your files wherever you go. FileFlex syncs your files across all your devices in real-time, allowing you to access them anywhere, anytime.</li>
      <li><strong>User-Friendly Interface:</strong> No need to waste time learning complex tools. FileFlex’s intuitive interface ensures that even those without tech expertise can efficiently organize, search, and manage their files.</li>
      <li><strong>Advanced Search:</strong> FileFlex’s advanced search feature ensures that you can find exactly what you need, when you need it. Whether you're searching by file name, type, or keyword, the powerful search engine will save you time and effort.</li>
      <li><strong>Organized Folder Structure:</strong> Say goodbye to clutter. FileFlex allows you to create a personalized folder structure that suits your workflow. You can group files by project, category, or any other method that suits your needs.</li>
      <li><strong>Version Control:</strong> Never lose an important change again. FileFlex’s version control feature automatically tracks document revisions, ensuring that you can roll back to previous versions with ease.</li>
      <li><strong>Security and Privacy:</strong> File security is a top priority for FileFlex. We offer encrypted storage to keep your data safe from unauthorized access. With two-factor authentication and regular security updates, your files are in safe hands.</li>
      <li><strong>Collaborative Tools:</strong> FileFlex is perfect for teams. With built-in collaboration tools, you can share files, provide feedback, and work together in real time. Your files stay organized, and communication remains smooth.</li>
      <li><strong>Cross-Platform Access:</strong> Whether you’re using a Windows PC, Mac, Android device, or iPhone, FileFlex works seamlessly across all platforms, ensuring that you can access your files wherever you are.</li>
      <li><strong>Automated Backup:</strong> Never worry about losing your data again. FileFlex automatically backs up your files to secure cloud storage, ensuring that your information is always protected.</li>
    </ul>

    <br />
    <h2>Features of FileFlex</h2>
    <ul>
      <li><strong>File Organization:</strong>
        <ul>
          <li>Easily categorize files with customizable folders and subfolders.</li>
          <li>Assign tags to files for faster retrieval.</li>
          <li>Group files based on specific criteria (e.g., file type, project, or deadline).</li>
        </ul>
      </li>
      <li><strong>Cloud Storage Integration:</strong>
        <ul>
          <li>Sync your files across all devices instantly.</li>
          <li>Access your documents from any internet-enabled device, at any time.</li>
          <li>Store files in the cloud with ample space, ensuring you never run out of room.</li>
        </ul>
      </li>
      <li><strong>File Sharing:</strong>
        <ul>
          <li>Share files with team members or clients with a few clicks.</li>
          <li>Set permissions for different users, including view-only and editable options.</li>
          <li>Create secure links for sharing large files that may be too large to email.</li>
        </ul>
      </li>
      <li><strong>Search and Filter:</strong>
        <ul>
          <li>Advanced search filters help you find files quickly and easily.</li>
          <li>Search by name, date modified, file type, and even by content with full-text search capabilities.</li>
          <li>Keep track of your most accessed files with personalized shortcuts.</li>
        </ul>
      </li>
      <li><strong>File Preview:</strong>
        <ul>
          <li>Preview documents, images, and other file types directly in the platform without needing to open them in a separate program.</li>
          <li>Save time and stay productive by previewing files on the go.</li>
        </ul>
      </li>
      <li><strong>Document Editing:</strong>
        <ul>
          <li>Edit documents within the system or integrate with popular editing tools like Microsoft Office or Google Docs.</li>
          <li>Make changes in real-time and collaborate with others on shared documents.</li>
        </ul>
      </li>
      <li><strong>Audit Trails and Reporting:</strong>
        <ul>
          <li>Track and log all file activities to keep an eye on who accessed or modified files.</li>
          <li>Generate reports on file activity, usage, and storage to ensure compliance and optimize your file management processes.</li>
        </ul>
      </li>
      <li><strong>File Compression and Conversion:</strong>
        <ul>
          <li>Save storage space by compressing files.</li>
          <li>Convert file types quickly and easily, ensuring compatibility with different applications.</li>
        </ul>
      </li>
    </ul>

    <br />
    <h2>Perfect for Businesses</h2>
    <p>Whether you are a small startup, a growing enterprise, or a large corporation, FileFlex provides all the tools you need to streamline your document management. FileFlex’s robust features are designed to support teams, enabling seamless collaboration, secure file sharing, and easy access to important business documents. With enterprise-level security, compliance tools, and integration with other business systems, FileFlex helps businesses operate more efficiently and securely.</p>

    <br />
    <h2>Perfect for Individuals</h2>
    <p>Managing personal documents, photos, and media files has never been easier. FileFlex provides you with a simple and reliable platform to store your important documents, photos, and media files. With easy organization, access, and sharing features, FileFlex ensures that your personal data is always just a click away—whether for personal use, sharing with friends, or archiving memories.</p>

    <br />
    <h2>FileFlex for Education</h2>
    <p>For students and educators, FileFlex is the perfect tool to keep track of lectures, research, assignments, and other essential academic materials. Its file-sharing and collaboration features make it easy to work together on projects, while its cloud sync ensures you can access your materials from anywhere, whether on campus, at home, or on the go.</p>

    <br />
    <h2>Get Started with FileFlex Today</h2>
    <p>Embrace the future of file management and take control of your digital world with FileFlex. Sign up today for a free trial and experience firsthand how FileFlex can streamline your workflow, increase productivity, and enhance your file organization efforts. Whether for personal or business use, FileFlex is here to transform the way you manage your digital files.</p>
    <p>We look forward to helping you organize and manage your files with ease and efficiency. Welcome to FileFlex—where file management meets simplicity and security!</p>

    <div class="getStartedDiv">
      <a href="index.php">Get Started</a>
    </div>
  </section>
</body>

<script>
  let ppt = document.getElementById("ppt");
  let folder = document.getElementById("folder");
  let doc = document.getElementById("doc");
  let pdf = document.getElementById("pdf");
  let mp3 = document.getElementById("mp3");
  let search = document.getElementById("search");
  let warning = document.getElementById("warning");
  let jpg = document.getElementById("jpg");

  window.addEventListener("scroll", () => {
    let value = window.scrollY;

    ppt.style.left = `${-2 - value * 0.1}%`;
    ppt.style.top = `${-0 - value * 0.1}%`;
    folder.style.left = `${-2 - value * 0.1}%`;
    folder.style.down = `${-2 - value * 0.1}%`;
    mp3.style.left = `${35 - value * 0.2}%`;
    mp3.style.top = `${5 - value * 0.2}%`;
    search.style.left = `${27 - value * 0.2}%`;

    doc.style.left = `${80 + value * 0.1}%`;
    doc.style.top = `${2 - value * 0.1}%`;
    pdf.style.left = `${85 + value * 0.1}%`;
    pdf.style.down = `${55 - value * 0.1}%`;
    warning.style.left = `${62 + value * 0.2}%`;
    jpg.style.left = `${65 + value * 0.2}%`;
  });
</script>

</html>