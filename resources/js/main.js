const { default: Axios } = require("axios");

"use strict";

// const create = document.getElementById();
// const edit = document.getElementById();
// const delet = document.getElementById();
// const save = document.getElementById();

// const view = document.getElementById();

const getData = () => {
    axios.post('http://localhost/wordpress/wp-admin/admin.php?page=idejos').then(response => {console.log(response);
});
};