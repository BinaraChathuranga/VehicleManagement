      
     //  $(".input").on('input',function(){
         
     // var x=document.getElementById('marPrice').value;
     // x=parseFloat(x);

     //  var y=document.getElementById('goldWeight').value;
     //  y=parseFloat(y);

     //   if(Number.isNaN(x))
     //   x=0;
     //   else if(Number.isNaN(y))
     //   y=0;
     //   else
   
     //   document.getElementById('ad').value=x*y;
    
     // });

     $('#goldWeight').keyup(function(){
          var mprice=parseFloat($('#mPrice').text());
          var goldw=parseFloat($(this).val());
          
        if(Number.isNaN(mprice))
        tmprice=0;
        else if(Number.isNaN(goldw))
        tmprice=0;
        else

        var tmprice=mprice*goldw;
          $('#tmPrice').val(tmprice.toFixed(2));

     });

     $('#goldWeight').keyup(function(){
          var aprice=parseFloat($('#asPrice').text());
          var goldw=parseFloat($(this).val());
          
        if(Number.isNaN(aprice))
        taprice=0;
        else if(Number.isNaN(goldw))
        taprice=0;
        else

        var taprice=aprice*goldw;
          $('#faPrice').val(taprice.toFixed(2));

     });

     $('#advance').keyup(function(){
          var intRate=parseFloat($('#interestRate').val());
          var advance=parseFloat($(this).val());
          
        if(Number.isNaN(intRate))
        interest=0;
        else if(Number.isNaN(advance))
        interest=0;
        else

        var interest=advance*intRate/100;
          $('#interest').val(interest.toFixed(2));

     });
       
     $('#advance').keyup(function(){
          var mainB=parseFloat($('#mainBalance').val());
          var ad=parseFloat($(this).val());
          var Total=parseFloat($('#totalBal').val());

          if(Number.isNaN(ad))
          mainBal=mainB.value();

          else
          var mainBal=Total-ad;
          $('#mainBalance1').val(mainBal.toFixed(2));

     });

    

      

       
       
