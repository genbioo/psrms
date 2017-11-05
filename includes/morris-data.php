<?php


$total_male = get_total('idp where gender = 1');
$total_female = get_total('idp where gender = 2');
$total_children = get_total('age', 'children');
$total_adults = get_total('age', 'adults');
$total_senior = get_total('age', 'senior');
#$total_undefined = get_total('age', 'undefined'); <-- apila ni ug visualize cal

if(!isset($_GET['evac_id']))
    {
        $evac_id = 1;
         $evac1_data = getDistinctDate($evac_id );
    }
else
    {
        $evac_id = $_GET['evac_id'];
         $evac1_data = getDistinctDate($evac_id );
    } 

?>


<script type="text/javascript">
	$(function() {
        var donut = new Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Male",
            value: <?php echo $total_male; ?>
        }, {
            label: "Female",
            value: <?php echo $total_female; ?>
        }],
        resize: true
         }).on('click', function (i, row) {  
               $('#myModal').modal({ show: true });
               $('.modal-title').text(row.label);
               $('.gender-donut').hide();
               $('#'+row.label+'-info').show();
            });

  for(i = 0; i < donut.segments.length; i++) 
  {
      donut.segments[i].handlers['hover'].push( function(i)
      {
        $('#morrisdetails-item').show();
        $("#morrisdetails-item").css({position:"absolute", top:event.pageY - 200, left: event.pageX-200});
        $('#morrisdetails-item .morris-hover-row-label').text("Click for more details");
      });
    }

 Morris.Donut({
        element: 'morris-donut2-chart',
        data: [{
            label: "Children",
            value: <?php echo $total_children; ?>
        }, {
            label: "Adults",
            value: <?php echo $total_adults; ?>
        }, {
            label: "Senior",
            value: <?php echo $total_senior; ?>
        }],
        resize: true
    });

  

    
});


</script>




<script type="text/javascript">
    $(function() {
      Morris.Area({
        element: 'evac1',
        data: [
        <?php 
            foreach($evac1_data as $row) {
             $date = $row['dates'];
            
             $idp_count = $row['total'];
             
        ?>

             { 
            period : '<?php echo $date; ?>',
            IDPS: '<?php echo $idp_count; ?>',
            
                 },
         <?php } ?>
        
        

        ],
        xkey: 'period',
        ykeys: ['IDPS'],
        labels: ['IDPS'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true,
       
       
    });
      });

</script>
