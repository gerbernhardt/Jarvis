const http = require('http');
const fs = require('fs');
const url = require('url').URL;

function handleRequest(request, response) {
    
    let params = new url('http://localhost' + request.url);
    var path = __dirname + '/http' + params.pathname;
    var ext = path.substr(path.length - 3, 3);
    var images = ['jpg','png','gif'];

    console.log(path);
    response.writeHead(200);
  
    if(fs.existsSync(path)) {
        if(fs.lstatSync(path).isDirectory()) {
            response.write(request.url);
        } else if(images.indexOf(ext) >= 0) {
            //response.writeHead(200, {'Content-Type': 'image/' + ext});
            response.write(fs.readFileSync(path));
        } else {
            var data = fs.readFileSync(path).toString();
            //response.writeHead(200,{'Content-Type': 'text/' + ext});
            response.write(data);
        }
    } else response.write(params.pathname);
    
    response.end();

}

var server = http.createServer(handleRequest).listen(80);