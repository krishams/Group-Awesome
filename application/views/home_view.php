<div id="home">
<h1>Welcome to home</h1>

<?php
$attributes = array('method' => 'post');
echo form_open('main/searchUserButton/',$attributes);
?>
<input type="text" name="search" onkeyup="showResult(this.value)"/>
<input type="submit" value="Search user" />

<?php
echo form_close();
?>
<div id="searchResults">

</div>

<script type="text/javascript">
    function showResult(str)
    {
        if (str.length==0)
        {
            document.getElementById("searchResults").innerHTML="";
            document.getElementById("searchResults").style.border="0px";
            return;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("searchResults").innerHTML=xmlhttp.responseText;
                document.getElementById("searchResults").style.border="1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET","/main/searchUser?q="+str,true);
        xmlhttp.send();
    }
</script>
</div>