<!--<script src="https://harvesthq.github.io/chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>-->
<!--  <script src="https://harvesthq.github.io/chosen/chosen.jquery.js" type="text/javascript"></script>-->
<!--  <script src="https://harvesthq.github.io/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>-->

<script src="<?= base_url('assets/chosen/jquery-3.2.1.min.js');?>" type="text/javascript"></script>
  <script src="<?= base_url('assets/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
  <script src="<?= base_url('assets/chosen/init.js');?>" type="text/javascript" charset="utf-8"></script>


<style>
    .footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color:white;
  color:#2d353c;  
  text-align: center;
  
}
</style>
<div class="row">
 <div class="footer" id="footer" >
        <p style='margin: 0.9375rem;'>
            <b style="font-size:13px;">© Copyright Eduwings by India active Software Inc <?= date('Y');?></b>
            
        <b  style="margin-left:2rem;">
        <span id="clockdate" style="float:right;">
    <span id="date" style="font-size:15px;"></span>
    <span id="clock" style="margin-left:1rem;margin-right:4rem;font-size:20px;color:#e82324;font-weight:bold"></span>
</span>
            </b>
            </p>
        
    </div>
    </div>
    <script>
            $('#dropdownYear').each(function() {

  var year = (new Date()).getFullYear();
  var current = year;
  year -= 4;
  for (var i = 0; i < 10; i++) {
    if ((year+i) == current)
      $(this).append('<option  value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) + ' - ' +  (year+1 + i) +'</option>');
    else
      $(this).append('<option value="' + (year + i) + '-' + (year+1 + i) + '">' + (year + i) +  ' - ' +  (year+1 + i) +'</option>');
  }

})
    </script>
<script>
    function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>
<script>
  $(document).ready(function(){  
			
			$('#section').change(function () {
			 // alert()
			    var val=$("#section").val();
			 //   alert(val);
			$.ajax({
            type: "POST",
            url: "<?= base_url('section')?>",
            data: { id: val},
            success : function(result)
            {
            //   alert(result);
    			//$('#item_modal').modal();
                $("#category").html(result);
    			//alert(result);
            }
            });
			});
  });
</script>
<script>
  $(document).ready(function(){  

        // JavaScript function to handle dropdown change
        $('.dropdown').on('change', function() {
            // Get the selected value from the dropdown
            const selectedValue = $(this).val();
// alert(selectedValue);
            if (selectedValue) {
                // Call the server to regenerate the session and process the dropdown value
                $.ajax({
                    url: '<?= base_url('regenerateSession'); ?>',  // URL to regenerate the session
                    method: 'POST',
                    data: { session_value: selectedValue },  // Send the selected value
                    success: function(response) {
                        // alert(response);
                        if (response.success) {
                            // Show a success message or update UI after session regeneration
                            // $('#result').html("Session has been regenerated. Selected value: " + selectedValue);
                            window.location.reload();  
                        } else {
                            $('#result').html("There was an error regenerating the session.");
                        }
                    },
                    error: function() {
                        $('#result').html("Error occurred while regenerating the session.");
                    }
                });
            } else {
                $('#result').html("Please select a valid option.");
            }
        });
  });
    </script>
<script src="<?= base_url('assets/js/vendor.min.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/js/app.min.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>


 <!--<script src="<?= base_url('assets/plugins/gritter/js/jquery.gritter.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>-->
<script src="<?= base_url('assets/plugins/flot/source/jquery.canvaswrapper.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.colorhelpers.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.saturated.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.browser.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.drawSeries.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.uiConstants.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.time.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.resize.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.pie.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.crosshair.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.categories.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.navigate.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.touchNavigate.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.hover.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.touch.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.selection.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.symbol.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/flot/source/jquery.flot.legend.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/jvectormap-next/jquery-jvectormap.min.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/jvectormap-content/world-mill.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>
<script src="<?= base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script> 
<script src="<?= base_url('assets/js/demo/dashboard.js'); ?>" type="00e94c9ca50fd6af82709095-text/javascript"></script>

<script src="<?= base_url('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js'); ?>" data-cf-settings="00e94c9ca50fd6af82709095-|49" defer></script> 
</body>
