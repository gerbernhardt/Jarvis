
let file = wapi.dialog('open', 'Text File \0*.txt\0');
file = 'E:/Documents/novedad.txt';
let data = jarvis.readTextFile(file);


let head = fs.readFileSync(modPath + 'head.rtf').toString();
let body = fs.readFileSync(modPath + 'body.rtf').toString();

for(let i = 0; i < data.length; i++) {
  append = body;
  append = append.replace(/XnombreX/, data[i]['nombre']);
  append = append.replace(/XsobreX/, data[i]['sobre']);
  append = append.replace(/XfechaX/, data[i]['fecha']);
  append = append.replace(/XdesdeX/, data[i]['desde']);
  append = append.replace(/XhastaX/, data[i]['hasta']);
  append = append.replace(/XtotalX/, data[i]['horas']);
  head += append;
}
head += '}';

let name = wapi.dialog('save', 'RTF File \0*.rtf\0');
if(name == '') process.exit();
if(name.substr(name.length - 4, 4) != '.rtf') name += '.rtf';
fs.writeFileSync(name, head);

process.exit();