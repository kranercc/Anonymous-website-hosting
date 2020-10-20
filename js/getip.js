const API_URL = `https://www.cloudflare.com/cdn-cgi/trace`;
        function onDataRecieve() {
            const ipRegex = /[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/                           
            const IP = xhttp.responseText.match(ipRegex)[0];
            document.getElementById("demo").innerHTML = IP
            alert(IP)
        }
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = onDataRecieve;
        xhttp.open("GET", API_URL, true);
        xhttp.send();


        