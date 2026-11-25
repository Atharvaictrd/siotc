<?= $this->extend('layout/tempmain') ?>

<?= $this->section('content') ?>
<?php
	$db      = \Config\Database::connect();
	$empId = trim((string) ($_GET['emp_id'] ?? ''));
	if ($empId === '') {
	    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Employee ID is required.');
	}
	$empData = $db->query("SELECT * FROM `employees` WHERE `emp_id` = ? LIMIT 0, 1", [$empId])->getRowArray();
	if (!$empData) {
	    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Employee not found.');
	}
	$month = ($_GET['month'] ?? '') . ', ' . ($_GET['year'] ?? '');
	$flag = 0;
	
	$checkSalarySQL = $db->query("SELECT * FROM `salaries` WHERE `emp_id` = ? AND `pay_month` = ?", [$empId, $month]);
	
	if ($checkSalarySQL) {
        $checkSalaryROW = $checkSalarySQL->getNumRows();
        if ($checkSalaryROW > 0) {
          $flag = 1;
          $empSalary = $db->query("SELECT * FROM `salaries` WHERE `emp_id` = ? AND `pay_month` = ?", [$empId, $month]);
        } else {
            $empHeads = $db->query("SELECT * FROM `employees` WHERE `emp_id` = ?", [$empId]);
        }
    }
?> 
<div id="content" class="app-content">
    <?php if(session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
      
      <?php if(session()->has('error')): ?>
          <div class="alert alert-danger alert-dismissible">
              <?= session('error') ?>
          </div>
      <?php endif; ?>
<div class="col-xl-12">

<div class="panel panel-inverse">

<div class="panel-heading">
<h3 class="panel-title" style="font-size: 1.3125rem;">Salary for <?php echo ($_GET['month'] ?? ''); ?>,<?=($_GET['year'] ?? '');?></h3>
<div class="panel-heading-btn">

</div>
</div>

<div class="panel-body">
<?php if ($flag == 0) { ?>
									<form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post" action="<?=base_url();?>generate_slip" enctype="multipart/form-data">
										<input type="hidden" name="month" value="<?php echo ($_GET['month'] ?? ''); ?>" />
										<input type="hidden" name="year" value="<?php echo ($_GET['year'] ?? ''); ?>" />
										
										<input type="hidden" name="emp_id" value="<?php echo $empData['emp_id']; ?>" />
										<input type="hidden" name="pay_month" value="<?php echo $month; ?>" />
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td width="20%">Employee ID</td>
													<td width="30%"><?php echo strtoupper($empData['emp_id']); ?></td>
													<td width="20%">Bank Name</td>
													<td width="30%"><?php echo ucwords($empData['bank_name']); ?></td>
												</tr>
												<tr>
													<td>Employee Name</td>
													<td><?php echo ucwords($empData['name']); ?></td>
													<td>Bank Account</td>
													<td><?php echo $empData['account_no']; ?></td>
												</tr>
												<tr>
													<td>Designation</td>
													<td><?php echo ucwords($empData['designation']); ?></td>
													<td>IFSC Code</td>
													<td><?php echo strtoupper($empData['ifsc_code']); ?></td>
												</tr>
												<tr>
													<td>Gender</td>
													<td><?php echo ucwords($empData['gender']); ?></td>
													<td>PAN</td>
													<td><?php echo strtoupper($empData['pan_no']); ?></td>
												</tr>
												<tr>
													<td>Location</td>
													<td><?php echo ucwords($empData['city']); ?></td>
													<td>PF Account</td>
													<td><?php echo strtoupper($empData['pf_account']); ?></td>
												</tr>
												<tr>
													<td>Department</td>
													<td><?php echo ucwords($empData['department']); ?></td>
													<td>Date of Joining</td>
													<td><?php echo $formattedDate = date('d-M-Y', strtotime($empData['doj'])); ?></td>
													
												</tr>
												
											</table>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th width="35%">Earnings</th>
														<th width="15%" class="text-right">Amount (Rs.)</th>
														<th width="35%">Deductions</th>
														<th width="15%" class="text-right">Amount (Rs.)</th>
													</tr>
												</thead>
												<tbody>
													<?php if (!empty($empHeads)) { ?>
														<tr>
															<td colspan="2" style="padding:0">
																<table class="table table-bordered table-striped" style="margin:0">
																	<?php
																	foreach ($empHeads->getResultArray() as $head) {
																	?>
																			<tr>
																				<td width="70%">
																				    <!--Basic Salary-->
																				    <input type="text" name="head_title[]" value="Basic Salary" class="form-control">
																				    <input type="hidden" name="head_type[]" value="earnings" class="form-control">
																				</td>
																				<td width="30%" class="text-right">
																					<input type="text" name="amounts[]" id="basic_salary" value="<?=$head['salary'];?>" class="form-control text-right" />
																				</td>
																			</tr>
																			<tr>
																				<td width="70%">
																				    <!--Overtime-->
																				    <input type="text" name="head_title[]" value="Overtime" class="form-control">
																				    <input type="hidden" name="head_type[]" value="earnings" class="form-control">
																				</td>
																				<td width="30%" class="text-right">
																					<input type="text" name="amounts[]" id="overtime" value="" class="form-control text-right" />
																				</td>
																			</tr>
																	<?php } ?>
																</table>
															</td>
															<td colspan="2" style="padding:0">
																<table class="table table-bordered table-striped" style="margin:0">
																	<?php
																	foreach ($empHeads->getResultArray() as $head) {
																	?>
																			<tr>
																			    <td width="70%">
																					<!--Other Deductions-->
																					<input type="text" name="head_title[]" value="Other Deductions" class="form-control">
																				    <input type="hidden" name="head_type[]" value="deductions" class="form-control">
																				</td>
																				<td width="30%" class="text-right">
																					<input type="text" name="amounts[]" id="deduction" class="form-control text-right" />
																				</td>
																			</tr>
																	<?php } ?>
																</table>
															</td>
														</tr>
													<?php } else { ?>
														<tr>
															<td colspan="4">No payheads are assigned for this employee</td>
														</tr>
													<?php } ?>
												</tbody>
												<tfoot>
													<tr>
														<td><strong>Total Earnings</strong></td>
														<td class="text-right">
														    <input type="hidden" name="totalEarnings" id="totalEarnings1">
															<strong id="totalEarnings"></strong>
														</td>
														<td><strong>Total Deductions</strong></td>
														<td class="text-right">
														    <input type="hidden" name="totalDeductions" id="totalDeductions1">
															<strong id="totalDeductions"></strong>
														</td>
													</tr>
												</tfoot>
											</table>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<h3 class="text-success" style="margin-top:0">
													Net Salary Payable:
													<span id="netSalary"></span>
													<input type="hidden" name="netSalary" id="netSalary1">
												</h3>
											</div>
											<div class="col-sm-6 text-right">
												<?php if (!empty($empHeads)) { ?>
													<button type="submit" class="btn btn-info">
														<i class="fa fa-plus"></i> Generate PaySlip
													</button>
												<?php } ?>
											</div>
										</div>
									</form>
								<?php } else { ?>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead> 
												<tr>
													<th width="35%">Earnings</th>
													<th width="15%" class="text-right">Amount (Rs.)</th>
													<th width="35%">Deductions</th>
													<th width="15%" class="text-right">Amount (Rs.)</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($empSalary)) { ?>
													<tr>
														<td colspan="2" style="padding:0">
															<table class="table table-bordered table-striped" style="margin:0">
																<?php 
																$totalEarnings = 0;
																foreach ($empSalary->getResultArray() as $salary) {
																?>
																	<?php if ($salary['pay_type'] == 'earnings') { ?>
																		<?php $totalEarnings += $salary['pay_amount']; ?>
																		<tr>
																			<td width="70%">
																				<?php echo $salary['payhead_name']; ?>
																			</td>
																			<td width="30%" class="text-right">
																				<?php echo number_format($salary['pay_amount'], 2, '.', ','); ?>
																			</td>
																		</tr>
																	<?php } ?>
																<?php } ?>
															</table>
														</td>
														<td colspan="2" style="padding:0">
															<table class="table table-bordered table-striped" style="margin:0">
																<?php 
																foreach ($empSalary->getResultArray() as $salary) {
																?>
																	<?php if ($salary['pay_type'] == 'deductions') { ?>
																		<?php $totalDeductions += $salary['pay_amount']; ?>
																		<tr>
																			<td width="70%">
																				<?php echo $salary['payhead_name']; ?>
																			</td>
																			<td width="30%" class="text-right">
																				<?php echo number_format($salary['pay_amount'], 2, '.', ','); ?>
																			</td>
																		</tr>
																	<?php } ?>
																<?php } ?>
															</table>
														</td>
													</tr>
												<?php } else { ?>
													<tr>
														<td colspan="4">No payheads are assigned for this employee</td>
													</tr>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<td><strong>Total Earnings</strong></td>
													<td class="text-right">
														<strong id="">
															<?php echo number_format($totalEarnings, 2, '.', ','); ?>
														</strong>
													</td>
													<td><strong>Total Deductions</strong></td>
													<td class="text-right">
														<strong id="">
															<?php echo number_format($totalDeductions, 2, '.', ','); ?>
														</strong>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<h3 class="text-success" style="margin-top:0">
												Net Salary Payable:
												Rs.<?php echo number_format(($totalEarnings - $totalDeductions), 2, '.', ','); ?><br>
												<small>(In words: <?php echo ucfirst(ConvertNumberToWords(($totalEarnings - $totalDeductions))); ?>)</small>
											</h3>
										</div>
										
										<div class="col-sm-6 text-right">
											<a class="btn btn-success" onClick="window.open('print_salary_slip?action=preview&id=<?php echo  $empData['id']; ?>&emp_id=<?php echo  $empData['emp_id']; ?>&month=<?=$month;?>','','menubar=no,width=990px,height=550px,scrollbars=yes,toolbar=no,titlebar=no,status=no,minimize=false');" >
												<i class="fa fa-download"></i> Show PaySlip
												<!--(PDF Version)-->
											</a>
											<!--<button type="button" class="btn btn-info" onclick="sendPaySlipByMail('<?php echo $empData['emp_id']; ?>', '<?php echo $month; ?>');">-->
											<!--	<i class="fa fa-envelope"></i> Send to Employee-->
											<!--</button>-->
										</div>
									</div>
								<?php } ?>
</div>
</div>
</div>
</div>
<?php

function ConvertNumberToWords($number) {
    $hyphen      = ' ';
    $conjunction = ' and ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'ConvertNumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . ConvertNumberToWords(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . ConvertNumberToWords($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = ConvertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= ConvertNumberToWords($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script>
        $(document).ready(function () {
            calculate();
            $('#basic_salary, #overtime, #deduction').keyup(function () {
               calculate();
           });
        });
        function calculate(){
          // Get values and convert them to numbers
            var basic_salary = parseFloat($('#basic_salary').val()) || 0; // Default to 0 if empty or invalid
            var overtime = parseFloat($('#overtime').val()) || 0; // Default to 0 if empty or invalid
            var deduction = parseFloat($('#deduction').val()) || 0; // Default to 0 if empty or invalid
            
            // Calculate the total salary
            var total_earn = basic_salary + overtime;
            var total_sal = total_earn - deduction;
        
            $('#totalEarnings').html(total_earn.toFixed(2));
            $('#totalDeductions').html(deduction.toFixed(2)); 
            $('#totalEarnings1').val(total_earn.toFixed(2));
            $('#totalDeductions1').val(deduction.toFixed(2));
            $('#totalDeductions1').html(deduction.toFixed(2)); 
           
           // Display the total salary in the respective fields
            $('#netSalary').html(total_sal.toFixed(2)); // Optional: Use .toFixed(2) for rounding to 2 decimal places
            $('#netSalary1').val(total_sal.toFixed(2));
        }
  </script>
<?= $this->endSection() ?>