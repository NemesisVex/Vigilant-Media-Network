##          Movable Type configuration file                   ##
##                                                            ##
## This file defines system-wide settings for Movable Type    ##
## In total, there are over a hundred options, but only those ##
## critical for everyone are listed below.                    ##
##                                                            ##
## Information on all others can be found at:                 ##
## http://www.movabletype.org/documentation/appendices/config-directives/ ##

################################################################
##################### REQUIRED SETTINGS ########################
################################################################

# The CGIPath is the URL to your Movable Type directory
CGIPath    http://mt.vigilantmedia.com/cgi-bin/mt/

# The StaticWebPath is the URL to your mt-static directory
# Note: Check the installation documentation to find out 
# whether this is required for your environment.  If it is not,
# simply remove it or comment out the line by prepending a "#".
StaticWebPath    /cgi-bin/mt/mt-static

#================ DATABASE SETTINGS ==================
#   CHANGE setting below that refer to databases 
#   you will be using.

##### MYSQL #####
ObjectDriver DBI::mysql
Database vigilantmedia
DBUser vigilantmedia
DBPassword 3825crux
DBHost mysql.vigilantmedia.com

PublishCharset UTF-8
NoHTMLEntities 1
SQLSetNames 1
DefaultLanguage en_US
DebugMode 0

AltTemplate comments comments.tmpl
AltTemplate search search.tmpl
AltTemplate filmsearch film.tmpl
AltTemplate reviewsearch reviews.tmpl
AltTemplate tvsearch tv.tmpl
AltTemplate archivesearch archive.tmpl
AltTemplate journalsearch journal.tmpl
AltTemplate meisakukisearch meisakuki.tmpl
AltTemplate sakufusearch sakufu.tmpl
AltTemplate ddnsearch ddn.tmpl
AltTemplate vexvoxsearch vexvox.tmpl
