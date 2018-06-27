<?php 
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Dashboard', '/employees/Dashboard',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Classes', '/sections',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Subjects', '/subjects',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Exams', '/Exams/',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Subject Details', '/sections/subjectDetails',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Students', '/students/add',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Student Elective Subject', '/StudentElectiveSubjects/add',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Employees', '/employees/index',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Marks', '/students/fillMarks',['escape' => false]).'</li>';
echo '<li>'.$this->Html->link($this->Html->tag('i', '', ['class' => 'icon-home']).'Student Attendance', '/students/studentAttendance',['escape' => false]).'</li>';

?>

<!-- <li class="start ">
	<a href="javascript:;">
	<i class="fa fa-building-o"></i>
	<span class="title">GRN</span>
	<span class="arrow "></span>
	</a>
	<ul class="sub-menu">
		<li><?php echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-plus-square']).' Create', '/Grns/Add',['escape' => false]); ?></li>
		<li><?php echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fa fa-list-ul']).' List', '/Grns',['escape' => false]); ?></li>
	</ul>
</li> -->

