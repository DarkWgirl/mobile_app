const http = require('http');

const fs = require('fs');

const hostname = "localhost";

const port = 3000;

		const server = http.createServer((req, res) => {
		res.statusCode = 200;
		});

	server.listen(port, hostname, () => {
	console.log('Server Started')
	});
