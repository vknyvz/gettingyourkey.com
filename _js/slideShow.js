function next()
			{
				if (pictures[current+1])
				{
					document.images.show.src = pictures[current+1].src;
					
					current++;
				}
				else
				{
					first();
				}
			}
			
			function previous()
			{
				if (current-1 >= 0)
				{
					document.images.show.src = pictures[current-1].src;
					current--;
				}
				else
				{
					last();
				}
			}
			
			function first()
			{
				current = 0;
				document.images.show.src = pictures[0].src;
			}
			
			function last()
			{
				current = pictures.length-1;
				document.images.show.src = pictures[current].src;
			}
			
			function resume()
			{
				if(stop == "true")
					stop = "false";
				else
					stop = "true";
			
				rotate();
			}
			
			function rotate()
			{
				if (stop == "true")
				{
					current = (current == pictures.length-1) ? 0 : current+1;
					document.images.show.src = pictures[current].src;
					window.setTimeout("rotate()", rotate_delay);
				}
			}