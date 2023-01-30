let count = 0;

document.getElementById("upbtn").onclick = function(){
  count+=1;
  document.getElementById("counter").innerHTML = count;
}

document.getElementById("downbtn").onclick = function(){
    count-=1;
    document.getElementById("counter").innerHTML = count;
}
