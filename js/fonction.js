function newgameprompt(linkto){
  var per = prompt("Please enter a username\n(maximum 20 alphanumeric or underscore characters)")
  if (per !==null && per !== ""){
    window.location.href="newgame.php"
  }
}
