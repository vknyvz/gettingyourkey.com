function checkDel(form)
{
	input = confirm("Are you sure you want to proceed with deletion? Click OK to continue, or CANCEL to abort.");

	if(input == true)				
	{ 
		return true;
	}
	else
	{
		return false;
	}
}