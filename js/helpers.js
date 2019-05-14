function readFileContent(file) {
  const reader = new FileReader()
  return new Promise((resolve, reject) => {
    reader.onload = event => resolve(event.target.result)
    reader.onerror = error => reject(error)
    reader.readAsText(file)
  })
}

function currentDateTime()
{
  var currentdate = new Date(); 
  var datetime = currentdate.getDate() + "/"
            + (currentdate.getMonth()+1)  + "/" 
            + currentdate.getFullYear() + " @ "  
            + currentdate.getHours() + ":"  
            + currentdate.getMinutes() + ":" 
            + currentdate.getSeconds();
  return datetime;
}

function wait(ms){
  var start = new Date().getTime();
  var end = start;
  while(end < start + ms) {
    end = new Date().getTime();
  }
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
