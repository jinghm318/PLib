<?php
// SHELL SYNTAX FILE
// THIS FILE IS AUTO-GENERATED
// DO NOT EDIT THIS IF YOU WISH TO KEEP IT
// IF YOU WISH TO MAKE CHANGES EDIT THE .STX FILE INSTEAD.

/** Color definitions */
$this->_COLOR['prefix4'] = '#930';
$this->_COLOR['posix_2'] = '#0000AA';
$this->_COLOR['unix_commands'] = '#CC0000';
$this->_COLOR['shell_vars'] = '#339900';

/** Preferenses */
$this->_PREFS['title'] = 'Bash';
$this->_PREFS['quotation1'] = '\'';
$this->_PREFS['quotation2'] = '"';
$this->_PREFS['continue_quote'] = 'n';
$this->_PREFS['linecomment'] = '#';
$this->_PREFS['escape'] = '\\';
$this->_PREFS['case'] = 'y';
$this->_PREFS['prefix4'] = '$';
$this->_PREFS['style_open_prefix4'] = '<b>';
$this->_PREFS['style_close_prefix4'] = '</b>';
$this->_PREFS['style_open_shell_vars'] = '<b>';
$this->_PREFS['style_close_shell_vars'] = '</b>';

/** Delimiters */
$this->_DELIMS = array('.',':','!','#','&','(',')','*',',','/',';','<','=','>','?','[','\\',']','`','{','|','}','~');

/** Built in functions and stuff */
$this->_KEYWORDS = array('posix_2'=>array('b'=>array(0=>'break',),'c'=>array(0=>'continue',1=>'case',2=>'cd',),'e'=>array(0=>'eval',1=>'exec',2=>'exit',3=>'export',4=>'echo',5=>'elif',6=>'else',7=>'esac',),'r'=>array(0=>'readonly',1=>'return',2=>'read',),'s'=>array(0=>'set',1=>'shift',2=>'select',3=>'stop',4=>'suspend',),'t'=>array(0=>'trap',1=>'typeset',2=>'test',3=>'then',4=>'time',5=>'times',6=>'true',7=>'type',),'u'=>array(0=>'unset',1=>'ulimit',2=>'umask',3=>'unalias',4=>'until',),'a'=>array(0=>'alias',),'d'=>array(0=>'do',1=>'done',),'f'=>array(0=>'false',1=>'fc',2=>'fi',3=>'for',4=>'function',5=>'functions',),'g'=>array(0=>'getopts',),'i'=>array(0=>'if',1=>'in',2=>'integer',),'j'=>array(0=>'jobs',),'k'=>array(0=>'kill',),'l'=>array(0=>'let',),'n'=>array(0=>'newgrp',1=>'nohup',),'p'=>array(0=>'print',1=>'ps',2=>'pwd',),'w'=>array(0=>'wait',1=>'whence',2=>'while',),'h'=>array(0=>'hash',1=>'history',),),'unix_commands'=>array('a'=>array(0=>'ar',1=>'asa',2=>'awk',3=>'abe',4=>'acl_edit',5=>'adb',6=>'adjust',7=>'admin',8=>'alias',9=>'at',10=>'audevent',11=>'audisp',12=>'audsys',13=>'audusr',14=>'autopush',15=>'abe',16=>'access',17=>'acctcom',18=>'acl',19=>'adb',20=>'addbib',21=>'adjacentscreens',22=>'adr900',23=>'adredit',24=>'align_equals',25=>'apropos',26=>'arch',27=>'as',28=>'asa',29=>'at',30=>'at900',31=>'at900pp',32=>'at971',33=>'at971pp',34=>'atq',35=>'atrm',36=>'auto_probe',37=>'avc',),'b'=>array(0=>'banner',1=>'basename',2=>'bc',3=>'bdiff',4=>'batch',5=>'bdf',6=>'bfs',7=>'bg',8=>'bos',9=>'bs',10=>'banner',11=>'bar',12=>'bash',13=>'batch',14=>'bdiff',15=>'biff',16=>'bitmap',17=>'bmadr',),'c'=>array(0=>'cal',1=>'calendar',2=>'cat',3=>'cc',4=>'chmod',5=>'cksum',6=>'clear',7=>'cmp',8=>'col',9=>'comm',10=>'compress',11=>'cp',12=>'cpio',13=>'crypt',14=>'csplit',15=>'ctags',16=>'cut',17=>'cancel',18=>'captoinfo',19=>'captoinfo_colr',20=>'ccat',21=>'cd',22=>'cdc',23=>'cdsadv',24=>'cdsclerk',25=>'cdscp',26=>'chacl',27=>'chatr',28=>'checknr',29=>'chfn',30=>'chgrp',31=>'chkey',32=>'chown',33=>'chsh',34=>'ci',35=>'cm',36=>'co',37=>'comb',38=>'command',39=>'compact',40=>'compressdir',41=>'cpset',42=>'crontab',43=>'csh',44=>'ct',45=>'cu',46=>'cue',47=>'cue.etc',48=>'cuegetty',49=>'cal_job',50=>'caladr',51=>'calcsheet',52=>'cancel',53=>'capitalize',54=>'cb',55=>'cdb',56=>'cdbclean',57=>'cdbreboot',58=>'cflow',59=>'chanadr',60=>'chandba',61=>'checkeq',62=>'checkmut',63=>'checknr',64=>'chfn',65=>'chgrp',66=>'chkey',67=>'chsh',68=>'cksum',69=>'clear_colormap',70=>'clear_functions',71=>'click',72=>'clock',73=>'cmdtool',74=>'colcrt',75=>'colrm',76=>'compile',77=>'crontab',78=>'crypt',79=>'csh',80=>'ctrace',81=>'cu',82=>'cxref',),'d'=>array(0=>'date',1=>'dc',2=>'dd',3=>'deroff',4=>'dev',5=>'df',6=>'diff',7=>'diff3',8=>'dircmp',9=>'dirname',10=>'du',11=>'dce_login',12=>'dcecp',13=>'dcnodes',14=>'delta',15=>'dfsbind',16=>'dfsd',17=>'dfstrace',18=>'diffmk',19=>'disable',20=>'dmpxlt',21=>'domainname',22=>'dos2ux',23=>'doschmod',24=>'doscp',25=>'dosdf',26=>'dosll',27=>'dosls',28=>'dosmkdir',29=>'dosrm',30=>'dosrmdir',31=>'dts_ntp_provider',32=>'dts_null_provider',33=>'dtscp',34=>'dtsd',35=>'dumpfs',36=>'dumpmsg',37=>'dbld',38=>'dbld_cache',39=>'dbld_inst',40=>'dbld_mpg',41=>'dbld_pat',42=>'dbld_pin',43=>'dbld_scan',44=>'dbld_spec',45=>'dbld_src',46=>'dbld_wave',47=>'dbx',48=>'dbxtool',49=>'defaultsedit',50=>'desktop',51=>'dev',52=>'dgenadr',53=>'dgendba',54=>'diffmk',55=>'dircmp',56=>'domainname',57=>'dos2unix',58=>'drs',59=>'ds',60=>'dumpkeys',),'e'=>array(0=>'echo',1=>'ed',2=>'egrep',3=>'env',4=>'ex',5=>'expand',6=>'expr',7=>'edit',8=>'elm',9=>'elmalias',10=>'enable',11=>'eucset',12=>'edit',13=>'eds',14=>'eject',15=>'enroll',16=>'eqn',17=>'error',),'f'=>array(0=>'false',1=>'fgrep',2=>'file',3=>'find',4=>'fmt',5=>'fold',6=>'factor',7=>'fc',8=>'fdetach',9=>'fdp',10=>'fg',11=>'findmsg',12=>'findstr',13=>'finger',14=>'fixman',15=>'fmt',16=>'forder',17=>'from',18=>'ftio',19=>'ftp',20=>'fts',21=>'fdformat',22=>'finger',23=>'fmt_mail',24=>'fontedit',25=>'from',26=>'ftp',),'g'=>array(0=>'getconf',1=>'getopt',2=>'grep',3=>'gres',4=>'gencat',5=>'genxlt',6=>'get',7=>'getaccess',8=>'getcellname',9=>'getip',10=>'getopts',11=>'getprivgrp',12=>'gprof',13=>'graphinfo',14=>'gres',15=>'grget',16=>'groups',17=>'gcore',18=>'get_alarm',19=>'get_selection',20=>'getconf',21=>'getoptcvt',22=>'gfxtool',23=>'gprof',24=>'graph',25=>'gres',26=>'groups',27=>'gvc',),'h'=>array(0=>'head',1=>'help',2=>'hash',3=>'hostname',4=>'hosts_to_named',5=>'hyphen',6=>'hazards',7=>'hcp',8=>'help',9=>'hostid',10=>'hostname',11=>'hostrfs',12=>'hpimtool',),'i'=>array(0=>'iconv',1=>'id',2=>'ident',3=>'ied',4=>'infocmp',5=>'infocmp_colr',6=>'insertmsg',7=>'inv',8=>'iostat',9=>'ipcrm',10=>'ipcs',11=>'i386',12=>'iAPX286',13=>'ibconf',14=>'ibic',15=>'iconedit',16=>'iconv',17=>'igcald',18=>'igrestart',19=>'igstart',20=>'igstatus',21=>'igstop',22=>'indent',23=>'indxbib',24=>'insadr',25=>'insert_brackets',26=>'install',27=>'insted',28=>'iostat',29=>'ipcrm',30=>'ipcs',31=>'it900',32=>'it971',),'j'=>array(0=>'join',1=>'jobs',2=>'j971vc',3=>'j971vctool',4=>'jcsd',5=>'jios',6=>'jobcp',7=>'jobio',8=>'jobtar',9=>'jobtool',),'k'=>array(0=>'kill',1=>'kdestroy',2=>'kermit',3=>'keylogin',4=>'keylogout',5=>'keysh',6=>'kftp',7=>'kinit',8=>'klist',9=>'kload',10=>'ksh',11=>'keylogin',12=>'keylogout',13=>'ksh',),'l'=>array(0=>'lc',1=>'line',2=>'ln',3=>'logname',4=>'look',5=>'ls',6=>'landiag',7=>'last',8=>'lastb',9=>'lastcomm',10=>'lc',11=>'ld',12=>'leave',13=>'lifcp',14=>'lifinit',15=>'lifls',16=>'lifrename',17=>'lifrm',18=>'listusers',19=>'ll',20=>'locale',21=>'localedef',22=>'lock',23=>'logger',24=>'login',25=>'look',26=>'lorder',27=>'lp',28=>'lpalt',29=>'lpr',30=>'lpstat',31=>'lsacl',32=>'lsf',33=>'lsr',34=>'lsx',35=>'last',36=>'lastcomm',37=>'lc',38=>'ld',39=>'ldd',40=>'leave',41=>'leveladr',42=>'leveldba',43=>'lex',44=>'lint',45=>'loader',46=>'loadkeys',47=>'lockscreen',48=>'logger',49=>'login',50=>'lookbib',51=>'lorder',52=>'lp',53=>'lpq',54=>'lpr',55=>'lprm',56=>'lpstat',57=>'lptest',58=>'lsw',59=>'lvc',),'m'=>array(0=>'m4',1=>'mail',2=>'mailx',3=>'make',4=>'man',5=>'mkdir',6=>'more',7=>'mt',8=>'mv',9=>'mailfrom',10=>'mailq',11=>'mailstats',12=>'mediainit',13=>'merge',14=>'mesg',15=>'metamail',16=>'mkfifo',17=>'mkmf',18=>'mkmsgs',19=>'mkpdf',20=>'mkstr',21=>'mktemp',22=>'mkuupath',23=>'mm',24=>'model',25=>'m68k',26=>'mach',27=>'mailtool',28=>'mailx',29=>'mc68010',30=>'mc68020',31=>'mesg',32=>'mfpadr',33=>'mfpdba',34=>'mkstr',35=>'mutadr',36=>'mutdba',),'n'=>array(0=>'nl',1=>'nm',2=>'ntps',3=>'neqn',4=>'netstat',5=>'newaliases',6=>'newform',7=>'newgrp',8=>'newmail',9=>'news',10=>'nfsstat',11=>'nice',12=>'nljust',13=>'nohup',14=>'nroff',15=>'nslookup',16=>'ntps',17=>'nawk',18=>'neqn',19=>'netstat',20=>'newaliases',21=>'newgrp',22=>'nice',23=>'nohup',24=>'nroff',25=>'nrsd',26=>'ntps',),'o'=>array(0=>'od',1=>'on',2=>'osdd',3=>'oladr',4=>'oldba',5=>'on',6=>'opint',7=>'opint_download',8=>'opint_version',9=>'overview',10=>'owadr',11=>'owdba',),'p'=>array(0=>'pack',1=>'paste',2=>'patch',3=>'pathchk',4=>'pax',5=>'pcat',6=>'perl',7=>'pg',8=>'pr',9=>'printf',10=>'ps',11=>'pwd',12=>'page',13=>'passwd',14=>'passwd_export',15=>'passwd_import',16=>'pathalias',17=>'pcltrans',18=>'pdfck',19=>'pdfdiff',20=>'pdfpr',21=>'pdp11',22=>'perl',23=>'posix',24=>'ppl',25=>'pplstat',26=>'praliases',27=>'prealloc',28=>'primes',29=>'printenv',30=>'prmail',31=>'prof',32=>'prs',33=>'ptx',34=>'pty',35=>'pwget',36=>'page',37=>'pagesize',38=>'passwd',39=>'patch',40=>'patdebug',41=>'patedit',42=>'patedit2.info',43=>'pathchk',44=>'pax',45=>'pdp11',46=>'perl',47=>'pg',48=>'pinadr',49=>'pindba',50=>'pmc',51=>'pmctool',52=>'preload',53=>'printenv',54=>'printf',55=>'prod',56=>'prof',57=>'ptx',58=>'puncture',),'r'=>array(0=>'red',1=>'rev',2=>'rm',3=>'rmdir',4=>'ranlib',5=>'rcp',6=>'rcs',7=>'rcsdiff',8=>'rcsmerge',9=>'rdist',10=>'read',11=>'readmail',12=>'remsh',13=>'renice',14=>'reset',15=>'revck',16=>'rexec',17=>'rgy_edit',18=>'rksh',19=>'rlog',20=>'rlogin',21=>'rmail',22=>'rmchg',23=>'rmdel',24=>'rmnl',25=>'rpccp',26=>'rpcd',27=>'rpcgen',28=>'rpcinfo',29=>'rsh',30=>'rtprio',31=>'rtsched',32=>'rup',33=>'ruptime',34=>'rusers',35=>'rwho',36=>'ranlib',37=>'rasfilter8to1',38=>'rasfilter_rgbtobgr',39=>'rastrepl',40=>'rcp',41=>'rdate',42=>'rdist',43=>'refer',44=>'regd',45=>'remove_brackets',46=>'reset',47=>'rf2ps',48=>'ring_alarm',49=>'rlogin',50=>'rm_memalloc',51=>'rmail',52=>'roffbib',53=>'rpcgen',54=>'rsh',55=>'rup',56=>'ruptime',57=>'rusers',58=>'rwho',),'s'=>array(0=>'sed',1=>'sh',2=>'size',3=>'sleep',4=>'sort',5=>'spell',6=>'split',7=>'start',8=>'strings',9=>'strip',10=>'stty',11=>'sum',12=>'sync',13=>'sact',14=>'sadp',15=>'sar',16=>'sbvtrans',17=>'sccs',18=>'sccsdiff',19=>'sccshelp',20=>'screenpr',21=>'script',22=>'sdiff',23=>'sec_admin',24=>'sec_clientd',25=>'serialize',26=>'shar',27=>'shl',28=>'showaudio',29=>'showexternal',30=>'shownonascii',31=>'showpicture',32=>'sig_named',33=>'slp',34=>'soelim',35=>'ssp',36=>'start',37=>'stcode',38=>'stmkfont',39=>'strace',40=>'strchg',41=>'strclean',42=>'strconf',43=>'strdb',44=>'strerr',45=>'strvf',46=>'su',47=>'s15vc',48=>'scanadr',49=>'scandba',50=>'sccs',51=>'screenblank',52=>'screendump',53=>'screenload',54=>'script',55=>'scrolldefaults',56=>'sdiff',57=>'selection_svc',58=>'semfd',59=>'set_alarm',60=>'sharc',61=>'shelltool',62=>'shift_lines',63=>'shmadr',64=>'shmoo',65=>'showtool',66=>'simclear',67=>'simd',68=>'simt_del',69=>'simtool',70=>'soelim',71=>'sortbib',72=>'sparc',73=>'specadr',74=>'specdba',75=>'specsheet',76=>'spline',77=>'sr_final',78=>'srcadr',79=>'srcdba',80=>'start',81=>'startadr',82=>'startdba',83=>'stop_regd',84=>'su',85=>'suntools',86=>'sunview',87=>'sunview1',88=>'svc',89=>'swin',90=>'switcher',91=>'symorder',92=>'sysmonitor',),'t'=>array(0=>'tail',1=>'tar',2=>'tee',3=>'test',4=>'touch',5=>'tr',6=>'true',7=>'tsort',8=>'tty',9=>'tabs',10=>'talk',11=>'tbl',12=>'tcio',13=>'tcsh',14=>'telnet',15=>'tftp',16=>'tic',17=>'tic_colr',18=>'time',19=>'timex',20=>'top',21=>'tput',22=>'tput_colr',23=>'tset',24=>'tsm',25=>'tsmstart',26=>'ttytype',27=>'type',28=>'t_version_convert',29=>'talk',30=>'tbl',31=>'tcopy',32=>'tcov',33=>'tdbx',34=>'tdbxtool',35=>'tdl_to_h',36=>'tektool',37=>'telnet',38=>'template_version_convert',39=>'template_version_convert.sed',40=>'tera_dbg',41=>'tera_dbg_stat',42=>'teradyneid',43=>'tervc',44=>'textedit',45=>'tftp',46=>'time',47=>'tip',48=>'tld',49=>'toold',50=>'toolplaces',51=>'trace',52=>'traffic',53=>'troff',54=>'tset',55=>'tvc',),'u'=>array(0=>'uname',1=>'uncompress',2=>'unexpand',3=>'uniq',4=>'unpack',5=>'uudecode',6=>'uuencode',7=>'u370',8=>'u3b',9=>'u3b10',10=>'u3b2',11=>'u3b5',12=>'udebug',13=>'ul',14=>'ulimit',15=>'umask',16=>'umodem',17=>'unalias',18=>'uncompact',19=>'uncompressdir',20=>'unget',21=>'unifdef',22=>'units',23=>'untic',24=>'uptime',25=>'users',26=>'uucp',27=>'uuidgen',28=>'uulog',29=>'uuls',30=>'uuname',31=>'uupath',32=>'uupick',33=>'uusnap',34=>'uusnaps',35=>'uustat',36=>'uuto',37=>'uux',38=>'ux2dos',39=>'u370',40=>'u3b',41=>'u3b15',42=>'u3b2',43=>'u3b5',44=>'ul',45=>'unifdef',46=>'units',47=>'unix2dos',48=>'unwhiteout',49=>'uptime',50=>'users',),'v'=>array(0=>'vi',1=>'vpax',2=>'vacation',3=>'val',4=>'vax',5=>'vc',6=>'vedit',7=>'view',8=>'vipw',9=>'vis',10=>'vmstat',11=>'vpax',12=>'vt',13=>'v2j',14=>'vacation',15=>'vacation.v5',16=>'vanl',17=>'vax',18=>'vcompress',19=>'vecadr',20=>'vecdba',21=>'vedit',22=>'vexpand',23=>'vgrind',24=>'view',25=>'vmstat',26=>'vpax',),'w'=>array(0=>'wc',1=>'which',2=>'who',3=>'wpaste',4=>'wstart',5=>'w',6=>'wait',7=>'what',8=>'whereis',9=>'whoami',10=>'whois',11=>'wpaste',12=>'write',13=>'wstart',14=>'w',15=>'wafermap',16=>'wall',17=>'waveadr',18=>'wavedba',19=>'wavetool',20=>'what',21=>'whatis',22=>'whereis',23=>'whoami',24=>'whois',25=>'wpaste',26=>'write',27=>'wspadr',28=>'wspdba',29=>'wstart',),'x'=>array(0=>'xargs',1=>'xd',2=>'xpg4',3=>'xstr',4=>'xget',5=>'xsend',6=>'xstr',),'z'=>array(0=>'zcat',1=>'zcmp',2=>'zdiff',3=>'zmuxdiag',4=>'zadr',),'X'=>array(0=>'X11',),'q'=>array(0=>'quota',1=>'quota',),'y'=>array(0=>'yes',1=>'ypcat',2=>'ypmatch',3=>'yppasswd',4=>'ypwhich',5=>'yacc',6=>'yes',7=>'ypcat',8=>'ypchfn',9=>'ypchsh',10=>'ypmatch',11=>'yppasswd',12=>'ypwhich',),'M'=>array(0=>'Mail',),'nochar'=>array(0=>'&&',1=>'<<',2=>'>>',3=>'[[',4=>'|&',5=>'||',6=>'~+',7=>'~-',),),'shell_vars'=>array('C'=>array(0=>'CDPATH',1=>'COLUMNS',),'E'=>array(0=>'EDITOR',1=>'ENV',2=>'ERRNO',),'F'=>array(0=>'FCEDIT',),'H'=>array(0=>'HISTFILE',1=>'HISTSIZE',2=>'HOME',),'I'=>array(0=>'IFS',),'L'=>array(0=>'LINENO',1=>'LINES',),'M'=>array(0=>'MAIL',1=>'MAILCHECK',2=>'MAILPATH',),'O'=>array(0=>'OLDPWD',),'P'=>array(0=>'PATH',1=>'PPID',2=>'PS1',3=>'PS2',4=>'PS3',5=>'PS4',6=>'PWD',),'R'=>array(0=>'RANDOM',1=>'REPLY',),'S'=>array(0=>'SECONDS',1=>'SHELL',),'T'=>array(0=>'TMOUT',),'V'=>array(0=>'VISUAL',),),);
?>