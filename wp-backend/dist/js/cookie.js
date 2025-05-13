function ReadCookie() {
   var allcookies = document.cookie;
   document.write ("All Cookies : " + allcookies );
   
   // Get all the cookies pairs in an array
   cookiearray = allcookies.split(';');
   
   // Now take key value pair out of this array
   for(var i=0; i<cookiearray.length; i++) {
      name = cookiearray[i].split('=')[0];
      value = cookiearray[i].split('=')[1];
      document.write ("Key is : " + name + " and Value is : " + value);
   }
}

function WriteCookie() {
   var now = new Date();
   now.setMonth( now.getMonth() + 1 ); // add Cookie
   // now.setMonth( now.getMonth() - 1 ); // For delete cookie
   if( document.myform.customer.value == "" ) {
      alert("Enter some value!");
      return;
   }
   cookievalue = escape(document.myform.customer.value) + ";";
   document.cookie = "name=" + cookievalue;
   document.cookie = "expires=" + now.toUTCString() + ";"
   document.write ("Setting Cookies : " + "name=" + cookievalue );
}