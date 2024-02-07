// navigation button active
let path = window.location.pathname.split('/');
let navs = document.querySelectorAll('.nav-item');

for(n of navs){
    if(n.id == path[1]){
        n.classList.add('active');
    }
    else if(n.id == 'home' && path[1].length < 1){
        document.getElementById('home').classList.add('active');
    }
}
//--------------------------


//hide toast message
setTimeout(function(){
    document.getElementById('toast').classList.add('hidden');
},3000);
//--------------------------


// delete model
let cmodel = document.getElementById('confirmModel');

function confirmDel(route,id){
    cmodel.classList.remove('hidden');
    cmodel.classList.add('flex');
    var form = document.getElementById('deleteForm');
    form.action = `${route}/${id}`
    console.log(form.action);
}

function closeModel(){
    cmodel.classList.remove('flex');
    cmodel.classList.add('hidden');
}

window.addEventListener('click',function(e){
    if(e.target.contains(cmodel)){
        closeModel();
    }
});
//--------------------------

