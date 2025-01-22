<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: Poppins, 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    table { 
        width: 100%;
        border-collapse: separate;
        /* Allows border-radius to work */
        border-spacing: 0;
        /* Removes spacing between cells */
        margin-top: 10px;
        color: #333;
        text-align: center;
        border: 1px solid lightgray;
        /* Adds a border to the table */
        border-radius: 12px;
        /* Rounds the outer corners */
        overflow: hidden;
        /* Ensures content fits within rounded corners */
    }

    td {
        border-bottom: 1px solid lightgray;
        padding: 6px 10px;
        font-size: 13px;
        a {
            
            text-decoration: none;
            color: #333;
        }

        svg {
            margin-right: 5px;
        }
    }

    .folderDiv {
        display: flex;
        /* Use flexbox for horizontal alignment */
        align-items: center;
        /* Vertically align items within the row */
        justify-content: center;
        /* Centers the group horizontally */
    }

    th {
        padding: 10px;
        background-color: #333;
        color: white;
    }

    /* Special styles for the first and last rows to match rounded corners */
    tr:first-child th:first-child {
        border-top-left-radius: 12px;
    }

    tr:first-child th:last-child {
        border-top-right-radius: 12px;
    }

    tr:last-child td:first-child {
        border-bottom-left-radius: 12px;
    }

    tr:last-child td:last-child {
        border-bottom-right-radius: 12px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
        /* Light gray for odd rows */
    }

    tr td:nth-child(4),
    tr td:nth-child(5),
    tr td:nth-child(6) {
        color: gray;
    }

    .navLink {
        text-decoration: none;
        color: inherit;
        padding: 5px 10px;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .navLink:hover {
        background-color: var( --hover-clr);
        /* Gray color on hover */
    }
</style>

<script>
    function openInNewTab(file) {

        // Open the file in a new ta
        window.open(file, '_blank');
    }
</script>