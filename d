[33mcommit 2026647a38a618df8e33564c8843b3d2bcf02d7c[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Sat Oct 3 16:46:01 2015 +0200

    Changed so login works with other users than Admin. Tryed with TestUser

[33mcommit 633368fb4a1bda34fb0481854b13fd59a66c9251[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Sat Oct 3 15:26:25 2015 +0200

    Shows correct form. Working on UserDAL

[33mcommit 3e3b2a2b45836b421f0b07bda31d0b04f8379930[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Sat Oct 3 01:02:47 2015 +0200

    pushing changes

[33mcommit 54504950a1d8e51cebc5f3e5a773dbb107d1294b[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Sat Oct 3 00:49:31 2015 +0200

    Shows loginform on press. No functionality yet

[33mcommit dac6f1c0c77a8d59e9125fdb57f79211de55418b[m
Merge: 6bf4505 ef03b0d
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Fri Oct 2 23:12:02 2015 +0200

    Merge conflict

[33mcommit ef03b0de2d470e91c030fc797a71cf0c199a4305[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Fri Oct 2 23:07:20 2015 +0200

    Pushing some changes

[33mcommit 6bf4505d954cec326234ce147de3db1179240f34[m
Merge: 6dd3fb6 8cc92bd
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Wed Sep 30 14:48:21 2015 +0200

    Merge branch 'master' of https://github.com/ad222kr/Login_1DV608-master

[33mcommit 6dd3fb64f27652bc8d284c2ce39e2c9c63971a83[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Wed Sep 30 14:47:40 2015 +0200

    Worked some more.

[33mcommit 8cc92bdc6791c99d7b375e31de1655add75ffb4e[m
Author: Alex Driaguine <ad222kr@student.lnu.se>
Date:   Thu Sep 24 04:23:47 2015 +0200

    Update README.md

[33mcommit 5c8c415a75b560a6f7be2872b1da028a043dfd5b[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Thu Sep 24 04:08:46 2015 +0200

    Some asserts added. Renamed token to cookie in methods etc to be consistent with the LoginView::CookieName static in LoginView

[33mcommit 19ff0fb0be6d0fa3a77e2259bffb93be250e2404[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Thu Sep 24 03:48:43 2015 +0200

    Done, cba doing more testcases. Need to sleep

[33mcommit b1f3c12f14714df5b96158d5191b7a36d26ae4ba[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Thu Sep 24 03:29:54 2015 +0200

    Added message for wrong cookie-info

[33mcommit 705888d58a9163932032d694ff10bea588c026d3[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Thu Sep 24 03:19:31 2015 +0200

    Changed implementation for login with cookie. Now uses token (ish) approach. New generated if user logs out and in again

[33mcommit 7b305f38f9f506b7146561a4f947095ce027f431[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Thu Sep 24 00:38:09 2015 +0200

    Some comments

[33mcommit 8b171024e5b9f8436f21b65206b11fb35f0c538a[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Wed Sep 23 20:00:33 2015 +0200

    Login with cookie works but not the prettiest implementation

[33mcommit 26d61dd7b421d35525c03c2eff6bbcb0bca5d564[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Wed Sep 23 17:33:29 2015 +0200

    Some refactoring. Now deletes the cookie if user logs out

[33mcommit 29598a8448430635daa3c62958d8870270d43dbb[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Wed Sep 23 10:58:51 2015 +0200

    Added interfaces to handle loginstate and setting temporary messages via session

[33mcommit 7d56a6d7af08a4f5657e8f078000f6c2094756b4[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Tue Sep 22 17:27:08 2015 +0200

    Started small on login via cookies

[33mcommit 7a3a7acc2d74ca129d08cac0a9f66ecd1a6bf498[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Tue Sep 22 17:05:16 2015 +0200

    Added the right feedback message on remember me

[33mcommit eed363412eafc76598c86149fd25f7537e77ce65[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Tue Sep 22 17:00:13 2015 +0200

    Started working with cookies. Now sets username and password hashed with SHA256 to cookies

[33mcommit 8cfd908b42b0b616993ad7d8fa0288f9a08c639c[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 18:46:02 2015 +0200

    SessionModel changed to SessionHandler, encapsulates session-behaviour for use in LoginView and LoginModel

[33mcommit f2d758eb3b0cfd0048bf3b16c0ba1b80a8f2147b[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 18:03:10 2015 +0200

    View now generates messages.

[33mcommit 6a40396646ca863f55c3615d9fac43db1a1ffd38[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 13:40:25 2015 +0200

    Now catches Users exceptions in the View

[33mcommit 20ae60f68eba514d613dca0d8098bdda368b6ad2[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 12:30:26 2015 +0200

    ..

[33mcommit 7e4abde9249b0e2509b9910c6c5bb3807eff0b9f[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 12:26:50 2015 +0200

    Test to set msg from controller

[33mcommit ed6cd3c92b0f19211dedd5a74e5dc6d0ee1541ff[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 12:20:28 2015 +0200

    testing to unset the logout post var

[33mcommit a06969d88deeafdfe5083d9ff80b8e8720ed5926[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 12:11:06 2015 +0200

    removed some not needed code from controller

[33mcommit 3743350eaed89ff03af9d0a2db1a59132b995226[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 12:10:09 2015 +0200

    Trying things for 2.4

[33mcommit 9a38ef107042eb0823ed6365fbfcbdc9ccd28fea[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 12:03:15 2015 +0200

    Inject loginModel to view

[33mcommit 9661e47a422b558430a1ecc419b9211ad970acba[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 00:52:57 2015 +0200

    Finished for today

[33mcommit 6dd0ad1db6b7962e81d00bf5986fda27b05677d1[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 21 00:07:01 2015 +0200

    Fixed indentation cus i dont know why 2.4 case does not work..

[33mcommit faf1a84fd796145ab92c214e2e1809f5189915a6[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Sun Sep 20 23:21:11 2015 +0200

    omg cant get 2.4 to work asdf

[33mcommit 783e5d7c76e6120855e0d2716cc1b36f279c0a15[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Sun Sep 20 22:28:19 2015 +0200

    Forgot to remove var_dump..

[33mcommit 41f13d4c3def0459b5d6374f380daf3551b86d6b[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Sun Sep 20 22:26:48 2015 +0200

    Change in LoginModel and controller, trying to get 2.4 to work

[33mcommit 720e0963014daa9077ca6259a548980831fe0870[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Sun Sep 20 22:19:55 2015 +0200

    Some refactoring..

[33mcommit 5c8760fb3f279cd27826678d618fab5b816d7e45[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Sun Sep 20 19:35:20 2015 +0200

    Added custom exception classes for Username/Password missing and wrong credentials. Session-model class added. View not returns user-object instead of strings with credentials

[33mcommit e6cee8b7566bd224761faaf66e10e8d09402ca89[m
Merge: 049ada5 bfa7f65
Author: Alex <ad222kr@student.lnu.se>
Date:   Sun Sep 20 12:39:27 2015 +0200

    Some merge conflicts...

[33mcommit 049ada55b313e4611d65aa6a2008cfc2959332ac[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Sun Sep 20 12:38:21 2015 +0200

    a

[33mcommit bfa7f6555ed03fb2fbbf8dc4f9951c8429fcdb84[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Fri Sep 18 17:11:48 2015 +0200

    Pushing minor changes, changing computer

[33mcommit 22d5b8a98a341d1a578b876062fb4494225b93f8[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Fri Sep 18 17:02:56 2015 +0200

    Shows feedback on first login, refresh removes welcome message. Same on logout

[33mcommit 7dbe0b208b5e9b892b121c3fb323ad9edcec7bf0[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Fri Sep 18 16:41:09 2015 +0200

    PRG and removes feedback if update on login-screen. Cannot logout twice with resend post-data

[33mcommit 919813453bcf93593a8aad1bca57f3bd8bfeb931[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Fri Sep 18 15:49:04 2015 +0200

    Changed strings to pass tests

[33mcommit 7f43dd6f8372e7807c03c390cd445e0216e5dff4[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Fri Sep 18 15:45:10 2015 +0200

    Bluescreen yesterday, forgot to commit after. Been working on implementing the MVC structure the righ way

[33mcommit 7f7a63bb0dc3357d3a6bd62a17f019a805575f42[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Wed Sep 16 16:44:16 2015 +0200

    CHanged things around. Added loginmodel that handles login and authentication of Users

[33mcommit 43897c848deb1b9c68dba9e873ead19652663511[m
Author: ad222kr <ad222kr@student.lnu.se>
Date:   Wed Sep 16 15:26:42 2015 +0200

    Post redirect get in view

[33mcommit 5d783cb4616f1cf856ed5ff0320632e4acdccc50[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Tue Sep 15 01:24:41 2015 +0200

    Forgot to commit before training so cant remeber changes..

[33mcommit 1b6260bd4014118f63d22ee8972f841c5dd90863[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 18:28:50 2015 +0200

    Removed feedback if page is reloaded and user is logged in

[33mcommit 9bb6ed34e6d1323c4c5c2d5b8de884e631414664[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 18:15:33 2015 +0200

    Removed var_dumps

[33mcommit f7da5d69a45e46b94eecc1dce95758d4b8dd3967[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 18:08:11 2015 +0200

    Removed var_dump

[33mcommit 4d1ab7d17ca3d8c7a1d79971c61793cd87b7d3cb[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 17:58:31 2015 +0200

    Session now keeps track if logged in. Works on reload

[33mcommit 9e4a1b40177b3394554dc28b131ab00523138d24[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 17:20:04 2015 +0200

    Started looking at SESSION

[33mcommit 82500a879a0b72851181c9ba1949bdfc0581a5bc[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 17:14:03 2015 +0200

    Fixed timestring formatting. Now Prints correct messages (User/pass missing or wring)

[33mcommit 5e46721a54c19ae2f804638fb23a6cc6e9746aef[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 16:01:49 2015 +0200

    Error messages for username and password. If pass is missing should save username in the field somehow

[33mcommit 42c299f63c1bfa86d70643594744e9f8256f2237[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 15:14:04 2015 +0200

    Removing var_dump else all tests fails

[33mcommit 8d71426f25fd5630bae910bfc24ab59e49a47633[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 15:12:06 2015 +0200

    Now shows the logout button. Got some problems with the message tho

[33mcommit 94e991ef27daea42bc12c607cf8ffbbd9f7da8c1[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 14:58:15 2015 +0200

    Removed var_dump

[33mcommit fe3f0e0ffa8ad347657b5b21f56443a5336e7a7c[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 14:50:42 2015 +0200

    Can login now

[33mcommit fe3ffd99b6edba3a0059a5ea105ceb725ee9984b[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Mon Sep 14 13:39:45 2015 +0200

    Time done

[33mcommit 7cbfe8c4e4de0fdb314b30dc34c8eb168677a209[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Fri Sep 11 15:38:35 2015 +0200

    Started assignment. Added some classes but generally I still feel lost

[33mcommit a893df1ae1a33329360e3d85d4f077631c5a5611[m
Author: Alex <ad222kr@student.lnu.se>
Date:   Fri Sep 11 13:18:59 2015 +0200

    Downloaded assignment shell

[33mcommit c4b1b1c976fe5e5e3ae811be8a8b5ec5854f49ad[m
Author: Alex Driaguine <ad222kr@student.lnu.se>
Date:   Fri Sep 11 13:15:49 2015 +0200

    Initial commit
