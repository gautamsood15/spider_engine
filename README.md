SPYDER_ENGINE is a web search engine that crawles the web and allows user to search it.

The search engine has both site and image search as well as pagination system.

It is made up of JS, PHP, and MySql to store all the data.
 
Xampp server is required to run the search engine


Schema for database for saving all the sites data.

TABLE NAME = sites


1	id    Primary(AI)	  int(11)		
2	url	                  varchar(512)	
3	title	              varchar(512)	
4	description	          varchar(512)	
5	keywords	          varchar(512)	
6	clicks	              int(11)			DEFAULT = As Defined(0)


-----------------------------------------------------------------------------------------------


TABLE NAME = images

1 	id    Primary(AI) 	  int(11) 			
2 	siteUrl 	          varchar(512) 	 	
3 	imageUrl 	          varchar(512) 
4 	alt 	              varchar(512) 	
5 	title 	              varchar(512) 	
6 	clicks 	              int(11) 	        DEFAULT = As Defined(0)
7 	broken 	              tinyint(4) 		DEFAULT = As Defined(0)


List of 3rd party CDN used:

1. JQuery   --   https://code.jquery.com/
2. Masonly  --   https://masonry.desandro.com/
3. Fancybox --   http://fancyapps.com/fancybox/3/
