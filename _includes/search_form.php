<!-- START SEARCH FORM -->
			<div id="search">
				<div class="shadow_left"></div>
				<div style="height: 90px;"></div>
					<form method="post" action="<?php echo $siteRoot; ?>/search.php">
					<ul>
						<li>
							State<br />
							<select name="state">
                            	<option>Please select</option>
								<option>Alabama</option>
								<option>Alaska</option>
								<option>Arizona</option>
								<option>Arkansas</option>
								<option>California</option>
								<option>Colorado</option>
								<option>Connecticut</option>
								<option>Delaware</option>
								<option>Florida</option>
								<option>Georgia</option>
								
								<option>Hawaii</option>
								<option>Idaho</option>
								<option>Illinois</option>
								<option>Indiana</option>
								<option>Iowa</option>
								<option>Kansas</option>
								<option>Kentucky</option>
								<option>Louisiana</option>								
								<option>Maine</option>
								<option>Maryland</option>
								
								<option>Massachusetts</option>
								<option>Michigan</option>
								<option>Minnesota</option>
								<option>Mississippi</option>
								<option>Missouri</option>
								<option>Montana</option>
								<option>Nebraska</option>
								<option>Nevada</option>								
								<option>New Hampshire</option>
								<option>New Jersey</option>
								
								<option>New Mexico</option>
								<option>New York</option>
								<option>North Carolina</option>
								<option>North Dakota</option>
								<option>Ohio</option>
								<option>Oklahoma</option>
								<option>Oregon</option>
								<option>Pennsylvania</option>								
								<option>Rhode Island</option>
								<option>South Carolina</option>
								
								<option>South Dakota</option>
								<option>Tennessee</option>
								<option>Texas</option>
								<option>Utah</option>
								<option>Vermont</option>
								<option>Virginia</option>								
								<option>Washington</option>
								<option>West Virginia</option>
								<option>Wisconsin</option>
								<option>Wyoming</option>
							</select>
						</li>
						<li>
							City/Town<br />
							<input type="text" name="city" class="big" />
						</li>
						<li>
							Zip Code<br />
							<input type="text" name="zip" class="small" />
						</li>
						<li>
							Min Price<br />
							<input type="text" name="price_min" class="small" />
						</li>
						<li>
							Max Price<br />
							<input type="text" name="price_max" class="small" />
						</li>
					</ul>
					<ul>
						<li class="select">
							Bedroom<br />
							<select name="bedroom">
                            	<option>0+</option>
								<option>1+ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option>2+</option>
								<option>3+</option>
								<option>4+</option>
								<option>5+</option>
                                <option>6+</option>
                                <option>7+</option>
                                <option>8+</option>
                                <option>9+</option>
                                <option>10+</option>
							</select>
						</li>
						<li class="select">
							Livingroom<br />
							<select name="livingroom">
                            	<option>0+</option>
								<option>1+ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option>2+</option>
								<option>3+</option>
								<option>4+</option>
								<option>5+</option>
                                <option>6+</option>
                                <option>7+</option>
                                <option>8+</option>
                                <option>9+</option>
                                <option>10+</option>
							</select>
						</li>
						<li class="select">
							Kitchen<br />
							<select name="kitchen">
                            	<option>0+</option>
								<option>1+ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option>2+</option>
								<option>3+</option>
								<option>4+</option>
								<option>5+</option>
                                <option>6+</option>
                                <option>7+</option>
                                <option>8+</option>
                                <option>9+</option>
                                <option>10+</option>
							</select>
						</li>
						<li class="select">
							Bathroom<br />
							<select name="bathroom">
                            	<option>0+</option>
								<option>0.5+ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<option>1+</option>
								<option>1.5+</option>
								<option>2+</option>
								<option>2.5+</option>
                                <option>3+</option>
                                <option>3.5+</option>
                                <option>4+</option>
                                <option>4.5+</option>
                                <option>5+</option>
							</select>
						</li>
						<li>
							Extra keywords (comma separated)<br />
							<input type="text" name="keywords" class="big" />
						</li>
						<li>
							<br />
							<input type="submit" value="Search" class="search" />
						</li>
					</ul>
					<div class="clearer"></div>
				</form>
				<div class="shadow_right"></div>
			</div>
			<!-- END SEARCH FORM -->