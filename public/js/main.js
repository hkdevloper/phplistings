function showToast(t="info",o="This is a toast message!"){switch(t){case"success":Toastify({text:o,duration:3e3,newWindow:!0,close:!0,gravity:"top",position:"right",stopOnFocus:!0,onClick:function(){},style:{background:"linear-gradient(to right, #67e198, #4fbfff)"}}).showToast();break;case"error":Toastify({text:o,duration:3e3,newWindow:!0,close:!0,gravity:"top",position:"right",stopOnFocus:!0,onClick:function(){},style:{background:"linear-gradient(to right, #e66767, #e6c667)"}}).showToast();break;case"warning":Toastify({text:o,duration:3e3,newWindow:!0,close:!0,gravity:"top",position:"right",stopOnFocus:!0,onClick:function(){},style:{background:"linear-gradient(to right, #e6c667, #4fbfff)"}}).showToast();break;case"info":Toastify({text:o,duration:3e3,newWindow:!0,close:!0,gravity:"top",position:"right",stopOnFocus:!0,onClick:function(){},style:{background:"linear-gradient(to right, #4fbfff, #67e198)"}}).showToast();break;default:return}}function shareButtonClicked(){navigator.share?navigator.share({title:"Share",text:"Check out this awesome website!",url:window.location.href}).then(()=>{showToast("success","Successfully shared!")}).catch(()=>{showToast("error","Failed to share!")}):showToast("error","Your browser does not support this feature!")}
