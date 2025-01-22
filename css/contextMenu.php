<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    *{
        font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .context-menu {
        position: absolute;
        display: none;
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        padding: 10px;
    }

    .context-menu button {
        background: none;
        border: none;
        color: #333;
        padding: 5px 10px;
        cursor: pointer;
        text-align: left;
    }

    .context-menu button:hover {
        background-color: #f0f0f0;
    }

    /* Add to Folder Form */
    .add-folder-form {
        display: none;
        margin-top: 10px;
    }

   
</style>