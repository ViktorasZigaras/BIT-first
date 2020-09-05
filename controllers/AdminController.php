<?php

namespace BIT\controllers;

use BIT\app\App;

class AdminController {
    public function __construct()
    {
        echo "Create HomeController";
    }

    function index() {
        echo PLUGIN_DIR_URL . '<br>';
        echo '
            <br>
            <button id="editButton"> Click </button>
        ';
        echo "<script language='javascript'>
            const editButton = document.querySelector('#editButton');
            // console.log(editButton);
            // console.log('JS');
            if (editButton) {
                editButton.addEventListener('click', () => { 
                    console.log('clicked');
                    axios.get('http://localhost/wordpress/wp-content/plugins/BIT-first/api/'), 
                    {route: test}
                    // get can also have params
                    .then((response) => {  
                        console.log(response);
                        // displayMessages(response.data);
                        // drawIndexInit();
                    })
                    .catch((error) => {
                        console.log(error);
                        // displayErrorMessages(error.response.data.errors);
                    });
                });
            }
        </script>";
    }
}