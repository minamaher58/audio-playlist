getTracks();
function getTracks() {
    let content='<div class="tracks">';
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let tracks = JSON.parse(this.responseText);
            tracks.tracks.forEach(track => {
            content +=`<div class="track">
                 <audio id="${track.url}" src="${track.url}"></audio>
                 <div class="track-info">
                     <span class="track-name">Name: ${track.name}</span>
                     <span class="track-artist">Artist: ${track.artist}</span>
                     <span class="track-length">Length: ${track.length}</span>
                 </div>
                 <div class="track-Control"> 
                      <i class="fas fa-cloud-download-alt" onclick="download('${track.url}')" style="cursor:pointer; color: white; font-size: 1.5rem;"></i>
                 </div>
             </div>`;
            }); 
            content += '</div>'
            document.body.innerHTML = document.body.innerHTML + content;
        }
    };
    xhttp.open("GET", "https://api.jsonbin.io/b/5f69e387302a837e956b59b5");
    xhttp.send();
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

function checkSession(url , sessionValue) {
    if(sessionValue) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response);
            }
        };
        xhttp.open("GET", "index.php?file="+url);
        xhttp.send();
        let base_url = window.location.origin;
        window.location.href = base_url+"/leap13/index.php?file="+url;
    } else {
        document.getElementById("myForm").style.display = "block";
        document.getElementById("trackurl").value = url;
    }
}

function login() {
    let userName = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let trackUrl = document.getElementById("trackurl").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           
            if(this.responseText === 'false') {
                
                alert("wrong username or password");
                window.location.href = window.location.origin+"/leap13/index.php";
            } 
            else { 
                document.getElementById("myForm").style.display = "none";
                window.location.href = window.location.origin+"/leap13/index.php?file="+trackUrl;
                setTimeout(function(){ 
                    window.location.href = window.location.origin+"/leap13/index.php";  
                }, 3000);
            }
        }
    };
    xhttp.open("POST", "auth.php");
    xhttp.setRequestHeader("Content-Type", "application/json");
    var data = {username: userName, password: password, url: trackUrl}
    xhttp.send(JSON.stringify(data));
    
}