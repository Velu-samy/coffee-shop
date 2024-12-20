document.getElementById("booking-form").addEventListener('submit',function(event){

    event.preventDefault();
    const randomnumber = Math.floor(1000 + Math.random() * 9000);
    localStorage.setItem('randomnumber', randomnumber);
    window.location.href='thankyou.html';


});

