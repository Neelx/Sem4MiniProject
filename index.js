const http = require("node:http");
const fs = require("node:fs");
const path = require("node:path");

const PORT = 8001;

const UI_PATH = path.join(process.cwd(), "./frontend");
const toBool = [() => true, () => false];

const MIME_TYPES = {
    default: "application/octet-stream",
    html: "text/html; charset=UTF-8",
    js: "application/javascript",
    css: "text/css",
    png: "image/png",
    jpg: "image/jpg",
    gif: "image/gif",
    ico: "image/x-icon",
    svg: "image/svg+xml",
  };  

const prepareFile = async (url) => {
    const paths = [UI_PATH, url];
    if (url.endsWith("/")) paths.push("index.html");
    const filePath = path.join(...paths);
    const pathTraversal = !filePath.startsWith(UI_PATH);
    const exists = await fs.promises.access(filePath).then(...toBool);
    const found = !pathTraversal && exists;
    const streamPath = found ? filePath : UI_PATH + "/404.html";
    const ext = path.extname(streamPath).substring(1).toLowerCase();
    const stream = fs.createReadStream(streamPath);
    return { found, ext, stream };
};

http
  .createServer(async(req, res) => {
    /* handle http requests */
    console.log(`${req.method} ${req.url}`);
    if (req.url.toLowerCase() !== '/api') {
        const file = await prepareFile(req.url);
        const statusCode = file.found ? 200 : 404;
        const mimeType = MIME_TYPES[file.ext] || MIME_TYPES.default;
        res.writeHead(statusCode, { "Content-Type": mimeType });
        file.stream.pipe(res);
        console.log(`${req.method} ${req.url} ${statusCode}`);
        } else {
            res.writeHead(200, { 'Content-Type': 'application/json' });
            res.end(JSON.stringify({
                data: 'Hello World!',
            }));
        } 
  })
  .listen(PORT);

console.log(`Server running at http://127.0.0.1:${PORT}/`);