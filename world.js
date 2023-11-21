window.onload = function () {
    var lookupbtn = document.getElementById("lookup");
    var citybtn = document.getElementById("cities");

    lookupbtn.addEventListener('click', function (e) {
        e.preventDefault();
        var lookupqueryfunc = document.getElementById("country").value;
        makeRequest("world.php?country=" + lookupqueryfunc);
    });

    citybtn.addEventListener("click", function (e) {
        e.preventDefault();
        var lookupqueryfunc = document.getElementById("country").value;
        makeRequest("world.php?country=" + lookupqueryfunc + "&context=cities");
    });

    function makeRequest(url) {
        var hrequest = new XMLHttpRequest();

        hrequest.onreadystatechange = function () {
            if (hrequest.readyState == XMLHttpRequest.DONE) {
                if (hrequest.status == 200) {
                    var country = hrequest.responseText;
                    var result = document.getElementById("result");
                    result.innerHTML = country;
                } else {
                    alert("Error Detected");
                }
            }
        };

        hrequest.open("GET", url, true);
        hrequest.send();
    }
};
