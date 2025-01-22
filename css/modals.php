<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        padding: 0;
        margin: 0;
        font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 1em;
        

        h2 {
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: left;
            font-weight: 600;
            border-bottom: 1px solid gray;
            padding: 0px 0px 15px 5px;
            color: #333;
        }
    }

    .close-btn {
        float: right;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    select {
        width: 200px;
        height: 40px;
        overflow-y: auto;
        padding: 5px;
        font-size: 14px;
    }

    select option {
        height: 30px;
    }

    .divs {
        display: flex;
        align-items: center;
        margin: 15px 0px;

        label {
            flex-basis: 200px;
        }

        #admin_file_name,
        #admin_folder_name {
            width: 53%;
            padding: 10px;
            border-radius: 20px;
            border: 0.5px solid gray;
        }

        select {
            width: 57%;
            padding: 10px;
            border-radius: 20px;
            border: 0.5px solid gray;
        }

        textarea {
            width: 56%;
            padding: 10px;
            border-radius: 20px;
            border: 0.5px solid gray;
            font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    }

    .createFileDiv {
        text-align: right;

        input {
            background-color: #128f8b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 30px;
        }
    }

    #admin_folder_shared {
    height: 90px; /* Adjust the height as needed */
}

.upload-icon {
    padding: 15px;
    border-radius: 10px;
    border: 2px dashed black;
    
    svg {
        background-color: red;    
    }
    p {
        cursor: default;
        font-size: 14px;
    }
}
</style>