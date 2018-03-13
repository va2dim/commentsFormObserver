Task Implement a Comment system as observer pattern (SPL).
Comment onSubmit Event is a Subject for Observation (Observable).
Observers (subsribers) initialise from `observers` DB table.
On Comment submit Event subsribers notified by comment with modified body (output at the top of screen).
From subsribers comment with modified body go for DB saving.

DB dump: ./cfe_test.sql
DB settings: ./config.php

Comment input can contain both native unicode emoji and shortnames, 
it will be converted to EmojiOne images for Subscribers display.

Test (comment) data: Hello world! :smile: 😄


Code was not covered by tests, as estimated time for task was finished.