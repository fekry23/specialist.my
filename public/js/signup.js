(()=>{var e=document.getElementById("employer"),t=document.getElementById("trainer"),n=(document.getElementById("create-account"),document.getElementById("back-button"));document.getElementById("user-type");function o(e){"employer"===e&&(document.getElementById(e).style.border="3px solid #89CFF0",document.getElementById(e).style.boxShadow="0 5px #666",document.getElementById(e).style.transform="translateY(4px)",d(e,"trainer")),"trainer"===e&&(document.getElementById(e).style.border="3px solid #89CFF0",document.getElementById(e).style.boxShadow="0 5px #666",document.getElementById(e).style.transform="translateY(4px)",d(e,"employer")),function(e){document.getElementById("create-account").disabled=!1,document.getElementById("create-account").style.backgroundColor="#89CFF0",document.getElementById("create-account").style.color="white",document.getElementById("create-account").style.border="3px solid #89CFF0",document.getElementById("create-account").style.cursor="pointer",document.getElementById("create-account").textContent="Apply as "+e}(e)}function d(e,t){"employer"===e&&(document.getElementById(t).style.removeProperty("transform"),document.getElementById(t).style.border="3px solid gray",document.getElementById(t).style.boxShadow="0 4px #999"),"trainer"===e&&(document.getElementById(t).style.removeProperty("transform"),document.getElementById(t).style.border="3px solid gray",document.getElementById(t).style.boxShadow="0 4px #999")}e.addEventListener("click",(function(){o("employer")})),t.addEventListener("click",(function(){o("trainer")})),n.addEventListener("click",(function(){document.getElementById("choose-method-container").style.display="flex",document.getElementById("user-signup-form").style.display="none"}))})();