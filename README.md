# README #

### What is this repository for? ###

* GEM Database Graphical user interface
* Version: Dev 0.1
* Technologies: PHP5, Ajax, javascript, HTML, CSS.
* Author: Mohammad Hasbuddin

This GUI is to automate the process of loading GEM construction data into database.
Data producers can do the following through it:

- Add parts ( PCBs, Foils, Vfats, GEB, Optohybrid,, etc..).
- Build chambers & super chambers
- Add QC data.
- Edit data
*  - De-attach/Attach parts from/to chamber
*  - De-attach/Attach chamber from/to super chamber

The Application backend generates XML files and automatically load it to the spool Area where the dbloader map it to the database. 

-------
### Code structure  ###

**note that**: **!!** means not used yet or for testing purposes

[ *** Directories *** ] 

* functions [ Contain all scripts with the back-end functions ]
* - SendXML.php  [ responsible for sending the XML to the spool area hosting server ]
* - ajaxActions.php  [ responsible for all Ajax requests/responses ]
* - functions.php   [ Hold functions with all back-end database queries  ]
* - generate_xml.php [ Holds Main function that generates XML files]
* gen_xml  [ Where Generated XML files Saved ]                              
* Uploads                          **!!**
* images [ includes front-end images and info-grapghics ]                 
* plugins [ includes front-end plugins ] 
* backup    **!!**                       
* bootstrap-datetimepicker  [ includes datepicker plugin ]  
* jQuery-Multiple-Select     [ includes datepicker plugin ]  
* shellscript        [ includes front-end needed shell scripts ] **!!** 
* bootstrap-datetimepicker-master [ includes bs datepicker plugin ] 
-------
* search.php [  Search for parts page ]
* head.php   [ Header of all pages, contains all file includes , globals , etc ]                                              
* first.php [ Main 1st page navigate to 4 sections ]
* Default.htm  [ Landing page ]
* test.php  [ for testing perpose ]  **!!**
* side.php  [ Sidebar ]  **!!**                                 
* foot.php  [ Footer for all pages, contains all JS ]
* contact.php [ Contact page ] 
-------
[ ***Show item pages *** ] 

* show_chamber.php
* show_drift.php
* show_gem.php  
* show_qc_iv.php
* show_qc_inspxn.php  **!!**
* show_readout.php  
* show_sup_chamber.php 
* show_vfat.php   
-------
[ ***List items pages*** ] 

* list_parts.php
* list_parts_drift.php
* list_parts_gem.php  
* list_parts_readout.php  
* list_parts_vfat.php    
* list_qc.php
* list_sup_chambers.php
* list_chambers.php 
-------
[ ***Edit item pages*** ] *under development*

* edit_chamber.php                  
* edit_drift.php
* edit_gem.php                                  
* edit_readout.php                    
* edit_sup_chamber.php                     
* edit_vfat.php 
-------
[ ***Create new item pages*** ] 

* new_readout.php
* new_vfat.php
* new_sup_chamber.php 
* new_drift.php 
* new_chamber.php  
* new_gem.php
* new_qc_inspxn.php **!!**
