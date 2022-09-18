document.getElementsByTagName("button").addEventListener(
    "submmit",
    function (e) {
        console.log(e.target.value);
        return e.target.value;
    },
    false
);
