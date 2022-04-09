var express = require('express');
var bodyParser = require('body-parser');
var app = express();
const startScrap = require('./scraper');

app.get('/', function(req, res){
   res.render('form');
});

app.set('view engine', 'pug');
app.set('views', './views');

// for parsing application/json
app.use(bodyParser.json()); 

// for parsing application/xwww-
app.use(bodyParser.urlencoded({ extended: true })); 
//form-urlencoded

// for parsing multipart/form-data
app.use(express.static('public'));

app.post('/', async function(req, res){
   await startScrap(req.body.link, req.body.start, req.body.end, req.body.index);
   res.render('form');
});
app.listen(3000);