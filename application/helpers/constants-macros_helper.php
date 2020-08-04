<?php

/*
  Created on : 01/10/2019, 10:30:00
  Author     : Enio Marcelo Buzaneli - eniomarcelo@gmail.com
 */



defined('BASEPATH') OR exit('No direct script access allowed');



/*
  |--------------------------------------------------------------------------
  | CONSTANTS MACROS
  |--------------------------------------------------------------------------
  |
  | CONSTANTES PARA AS MACROS DO SISTEMA
  |
 */


/**
 * ========================================================================================================================================================================
 *  MACRO CODE
 * ========================================================================================================================================================================
 */
/* INSERT, UPDATE, DELETE */
define('___MACRO_DATABASE_INSERT___', "LyoqCiAqIElOU0VSVCBEQVRBIElOVE8gVEFCTEUKICovCiRfdGFibGU9ICdjYWRfY2xpZW50ZSc7IC8vIE5vbWUgZGEgc3VhIHRhYmVsYQokX2RhdGEgPSBbXTsgLy8gRGFkb3MgcGFyYSBpbnNlcmlyIG5hIHRhYmVsYSBFeDogJF9kYXRhWydmaWVsZDEnPT4neHh4JywgJ2ZpZWxkMic9Pid5eXknXTsKCiRfcmVzdWx0ID0gbWNfaW5zZXJ0RGF0YURCKCRfdGFibGUsICRfZGF0YSk7CgppZiAoJF9yZXN1bHQpewogICAgIHNldF9tZW5zYWdlbV9ub3RmaXQoX19fTVNHX0FERF9SRUdJU1RST19fXywgJ3N1Y2Nlc3MnKTsKfWVsc2V7CiAgICAgZWNobyAnRXJybyBhbyBpbnNlcmlyIERhZG9zLic7CiAgICAgZXhpdDsKfQovKiBFTkQgIElOU0VSVCBEQVRBIElOVE8gVEFCTEUgKi8K");
define('___MACRO_DATABASE_UPDATE___', "LyoqCiAqIFVQREFURSBEQVRBIElOVE8gVEFCTEUKICovCiRfdGFibGU9ICcnOyAvLyBOb21lIGRhIHN1YSB0YWJlbGEKJF93aGVyZSA9ICcnOyAvL0V4OiBXSEVSRSBpZCA9IDE7CiRfZGF0YSA9IFtdOyAvLyBEYWRvcyBwYXJhIGF0dWFsaXphIG5hIHRhYmVsYSBFeDogJF9kYXRhWydmaWVsZDEnPT4neHh4JywgJ2ZpZWxkMic9Pid5eXknXTsKCiRfcmVzdWx0ID0gbWNfdXBkYXRlRGF0YURCKCRfdGFibGUsICRfZGF0YSwgJF93aGVyZSk7CgppZiAoJF9yZXN1bHQpewogICAgIHNldF9tZW5zYWdlbV9ub3RmaXQoX19fTVNHX0FERF9SRUdJU1RST19fXywgJ3N1Y2Nlc3MnKTsKfWVsc2V7CiAgICAgZWNobyAnRXJybyBhbyBhdHVhbGl6YXIgRGFkb3MuJzsKICAgICBleGl0Owp9Ci8qIEVORCAgVVBEQVRFIERBVEEgSU5UTyBUQUJMRSAqLw==");
define('___MACRO_DATABASE_DELETE___', "LyoqCiAqIERFTEVURSBEQVRBIElOVE8gVEFCTEUKICovCiRfdGFibGU9ICcnOyAvLyBOb21lIGRhIHN1YSB0YWJlbGEKJF93aGVyZSA9ICcnOyAvL0V4OiBXSEVSRSBpZCA9IDE7CgokX3Jlc3VsdCA9IG1jX2RlbGV0ZURhdGFEQigkX3RhYmxlLCAkX3doZXJlKTsKCmlmICgkX3Jlc3VsdCl7CiAgICAgc2V0X21lbnNhZ2VtX25vdGZpdChfX19NU0dfREVMX1JFR0lTVFJPX19fLCAnc3VjY2VzcycpOwp9ZWxzZXsKICAgICBlY2hvICdFcnJvIGFvIGRlbGV0YXIgRGFkb3MuJzsKICAgICBleGl0Owp9Ci8qIEVORCBERUxFVEUgREFUQSBJTlRPIFRBQkxFICov");

/* FIND DATA IN TABLE */
define('___MACRO_ARRAY_FIND_ALL___', "LyoqCiAqIFNFTEVDVCBBTEwgREFUQSBJTiBUQUJMRQogKi8KJF90YWJsZT0gJyc7IC8vIE5vbWUgZGEgc3VhIHRhYmVsYQokX29yZGVyQnkgPSAnJzsgLy8gQ2FtcG9zIHBhcmEgb3JkZW5hw6fDo28uIEV4OiBmaWVsZDEgQVNDLCBmaWVsZDIgREVTQwoKJF9yZXN1bHQgPSBtY19maW5kQWxsRGF0YURCKCRfdGFibGUsICRfb3JkZXJCeSktPnJlc3VsdCgpOwoKLyogRU5EIFNFTEVDVCBBTEwgREFUQSBJTiBUQUJMRSAqLw==");
define('___MACRO_ARRAY_FIND_BY_ID___', "LyoqCiAqIFNFTEVDVCBCWSBJRCBEQVRBIElOIFRBQkxFCiAqLwokX3RhYmxlPSAnJzsgLy8gTm9tZSBkYSBzdWEgdGFiZWxhCiRfaWQ9ICcnOyAvLyBDYW1wbyBJRCBkYSBzdWEgdGFiZWxhCgokX3Jlc3VsdCA9IG1jX2ZpbmRCeUlkRGF0YURCKCRfdGFibGUsICRfaWQpLT5yb3coKTsKCi8qIEVORCBTRUxFQ1QgQlkgSUQgREFUQSBJTiBUQUJMRSAqLwoKCgoK");
define('___MACRO_ARRAY_FIND_BY_FIELD___', "LyoqCiAqIFNFTEVDVCBCWSBGSUVMRCBEQVRBIElOIFRBQkxFCiAqLwokX3RhYmxlPSAnJzsgLy8gTm9tZSBkYSBzdWEgdGFiZWxhCiRfZmllbGROYW1lPSAnJzsgLy8gTm9tZSBkbyBjYW1wbwokX2ZpZWxkVmFsdWUgPSAnJzsgLy8gVmFsb3IvRGFkbyBxdWUgY29udMOpbSBubyBjYW1wbyBwYXJhIHNlciBwZXNxdWlzYWRvCiRfb3JkZXJCeSA9ICcnOyAvLyBDYW1wb3MgcGFyYSBvcmRlbmHDp8Ojby4gRXg6IGZpZWxkMSBBU0MsIGZpZWxkMiBERVNDCiRfY29uZGl0aW9uID0nbGlrZSc7IC8vIFBhcmEgcGVzcXVpc2FyIHF1YWxxdWVyIHBhcnRlIGRvIHRleHRvLiBGQUxTRSBwYXJhIHBlc3F1aXNhciBleGF0YW1lbnRlIGlndWFsIGFvIHZhbG9yIGRlICRfZmllbGRWYWx1ZQoKJF9yZXN1bHQgPSBtY19maW5kQnlGaWVsZERhdGFEQigkX3RhYmxlLCAkX2ZpZWxkTmFtZSwgJF9maWVsZFZhbHVlLCAkX2NvbmRpdGlvbiAsICRfb3JkZXJCeSktPnJlc3VsdCgpOwoKLyogRU5EIFNFTEVDVCBCWSBGSUVMRCBEQVRBIElOIFRBQkxFICov");
define('___MACRO_ARRAY_FIND_WHERE_PARAM___', "LyoqCiAqIFNFTEVDVCBXSEVSRSBQQVJBTSBEQVRBIElOIFRBQkxFCiAqLwokX3RhYmxlPSAnJzsgLy8gTm9tZSBkYSBzdWEgdGFiZWxhCiRfd2hlcmUgPSAnJzsgLy9FeDogV0hFUkUgaWQgPSAxOwokX29yZGVyQnkgPSAnJzsgLy8gQ2FtcG9zIHBhcmEgb3JkZW5hw6fDo28uIEV4OiBPUkRFUiBCWSBmaWVsZDEgQVNDLCBmaWVsZDIgREVTQwokX3BhcmFtPSBbXTsgLy8gRXg6IFsnZGlzdGluY3QnID0+ICduYW1lX2ZpZWxkJ107CgokX3Jlc3VsdCA9IG1jX3NlbGVjdERhdGFEQiggJF90YWJsZSwgJF93aGVyZSAuJyAnLiAkX29yZGVyQnksICRfcGFyYW0pLT5yZXN1bHQoKTsKCi8qIEVORCBTRUxFQ1QgV0hFUkUgUEFSQU0gREFUQSBJTiBUQUJMRSAqLwoKCgoKCgoKCg==");

/* AUDITORIA */
define('___MACRO_AUDITORIA_ADD___', "LyoqCiAqIE1BQ1JPIEdSQVZBIFVNQSBBVURJVE9SSUEKICoKICogJGRhZG9zQXVkaXRvcmlhWydhY3Rpb24nXSA9ICdhZGQnOyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgUXVhbCBhw6fDo28gZm9pIGV4ZWN1dGFkYS4gRXg6IEFERCBxdWFuZG8gZmF6IHVtYSBpbmNsdXPDo28gZGUgcmVnaXN0cm8sIEVESVQgcXVhbmRvIGZheiBhbGd1bWEgYWx0ZXJhw6fDo28gbm8gcmVnaXN0cm8sIERFTCBxdWFuZG8gZXhjbHVpIHVtIHJlZ2lzdHJvCiAqICRkYWRvc0F1ZGl0b3JpYVsnZGVzY3JpcHRpb24nXSA9ICdNZW5zYWdlbSBkYSBBdWRpdG9yaWEnOyAgICAgIE1lbnNhZ2VtIHBhcmEgaW5mb3JtYXIgbyBtb3Rpdm8gZGEgQXVkaXRvcmlhCiAqLwokZGFkb3NBdWRpdG9yaWFbJ2FjdGlvbiddID0gJ2FkZCc7CiRkYWRvc0F1ZGl0b3JpYVsnZGVzY3JpcHRpb24nXSA9ICdNZW5zYWdlbSBkYSBBdWRpdG9yaWEnOwokX3IgPSBtY19hZGRfYXVkaXRvcmlhKCRkYWRvc0F1ZGl0b3JpYSk7");

/* MODELOS */
define('___MACRO_MODELO_MODAL___', "LyoqCiAqIE1PREFMCiAqIAogKiBQQVLDgk1FVFJPUyBEQSBNT0RBTAogKiAKICogbW9kYWxOYW1lICAgICAgICAgICAgICAgICAgICAgICBOb21lIGRhIE1vZGFsLCBzZSBuw6NvIGZvciBpbmZvcm1hZG8gbyBub21lIHBhZHLDo28gc2Vyw6EgYnpNb2RhbAogKiBtb2RhbENsYXNzQ3NzICAgICAgICAgICAgICAgICAgIFBhcmEgYWRpY2lvbmFyIHVtYSBjbGFzc2UgQ1NTIG5hIG1vZGFsCiAqIG1vZGFsU2l6ZSAgICAgICAgICAgICAgICAgICAgICAgICAgRGV0ZXJtaW5hIG8gdGFtYW5obyBkYSBtb2RhbCAtIEV4OiBsYXJnZSBwYXJhIEdyYW5kZSwgc21hbGwgcGFyYSBQZXF1ZW5vLiBTZSBuw6NvIGZvciBpbmZvcm1hZG8gbmFkYSBvIHRhbW5obyBwYWRyw6NvIHNlcsOhIE3DqWRpbwogKiBtb2RhbFRpdGxlICAgICAgICAgICAgICAgICAgICAgICAgICBPIFTDrXR1bG8gcGFyYSBhIE1vZGFsCiAqIG1vZGFsVGV4dCAgICAgICAgICAgICAgICAgICAgICAgICAgTyBUZXh0byBubyBjb3JwbyBkYSBNb2RhbAogKiBtb2RhbFRleHRTbWFsbCAgICAgICAgICAgICAgICAgIE8gVGV4dG8gZGUgdGFtYW5obyByZWR1emlubyBubyBjb3JwbyBkYSBNb2RhbAogKiBtb2RhbEJ0bkNsb3NlSWRDc3MgICAgICAgICAgICBJRCBkbyBib3TDo28gcXVlIGZlY2hhIGEgTW9kYWwKICogbW9kYWxCdG5Db25maXJtSWRDc3MgICAgICAgIElEIGRvIGJvdMOjbyBkZSBjb25maXJtYcOnw6NvIGRhIE1vZGFsCiAqIG1vZGFsQnRuQ2xvc2UgICAgICAgICAgICAgICAgICAgIFRleHRvIGRvIGJvdMOjbyBxdWUgZmVjaGEgYSBNb2RhbAogKiBtb2RhbEJ0bkNvbmZpcm0gICAgICAgICAgICAgICAgVGV4dG8gbyBib3TDo28gZGUgY29uZmlybWHDp8OjbyBkYSBNb2RhbAogKiBtb2RhbFNob3cgICAgICAgICAgICAgICAgICAgICAgICAgU2UgaW5mb3JtYWRvIGNvbW8gVFJVRSBhIE1vZGFsIMOpIGV4ZWN1dGFkYSBhdXRvbWF0aWNhbWVudGUKICogCiAqLwogCiRfY29uZmlnTW9kYWxbJ21vZGFsTmFtZSddID0gJ01vZGFsTmFtZScgOwokX2NvbmZpZ01vZGFsWydtb2RhbENsYXNzQ3NzJ10gPSAnbW9kYWxDbGFzc0NzcycgOwokX2NvbmZpZ01vZGFsWydtb2RhbFNpemUnXSA9ICcnIDsKJF9jb25maWdNb2RhbFsnbW9kYWxUaXRsZSddID0gJ1TDrXR1bG8gZGEgTW9kYWwnIDsKJF9jb25maWdNb2RhbFsnbW9kYWxUZXh0J10gPSAnVGV4dG8gZGEgTW9kYWwnIDsKJF9jb25maWdNb2RhbFsnbW9kYWxUZXh0U21hbGwnXSA9ICdUZXh0byBTbWFsbCBkYSBNb2RhbCcgOwokX2NvbmZpZ01vZGFsWydtb2RhbEJ0bkNsb3NlSWRDc3MnXSA9ICdpZEJ0bkNsb3NlJyA7CiRfY29uZmlnTW9kYWxbJ21vZGFsQnRuQ29uZmlybUlkQ3NzJ10gPSAnaWRCdG5Db25maXJtJyA7CiRfY29uZmlnTW9kYWxbJ21vZGFsQnRuQ2xvc2UnXSA9ICdGZWNoYXInIDsKJF9jb25maWdNb2RhbFsnbW9kYWxCdG5Db25maXJtJ10gPSAnT0snIDsKJF9jb25maWdNb2RhbFsnbW9kYWxTaG93J10gPSB0cnVlOyAKIAokdGhpcy0+ZGFkb3NbJ21vZGFsR3JpZExpc3QnXSA9IG1jX21vZGFsKCAkX2NvbmZpZ01vZGFsICk7Ci8vJHRoaXMtPmRhZG9zWydtb2RhbEZvcm1BZGQnXSA9IG1jX21vZGFsKCAkX2NvbmZpZ01vZGFsICk7Ci8vJHRoaXMtPmRhZG9zWydtb2RhbEZvcm1FZGl0J10gPSBtY19tb2RhbCggJF9jb25maWdNb2RhbCApOwo=");
define('___MACRO_MODELO_ALERT_TRIGGER_NOTFI___', "LyoqCiogQUxFUlRBUyBETyBTSVNURU1BIEVNIFRSSUdHRVIgTk9USUZJVEkgTUVTU0VOR0VSCioKKiBUaXBvcyBkZSBBbGVydGFzOiBlcnJvciwgd2FybmluZywgc3VjY2VzcywgaW5mbwoqCiovCiRfYWxlcnRNZW5zYWdlbSA9ICdNZW5zYWdlbSBkbyBBbGVydGEnOwokX2FsZXJ0VGlwbyA9ICdpbmZvJzsKbWNfYWxlcnRUcmlnZ2VyTm90aWZpKCAkX2FsZXJ0TWVuc2FnZW0sICRfYWxlcnRUaXBvICk7Cgo=");
define('___MACRO_MODELO_ALERT_NOTFIT___', "LyoqCiAqIEFMRVJUQVMgRE8gU0lTVEVNQSBFTSBOT1RGSVQgTUVTU0VOR0VSCiAqCiAqIFRpcG9zIGRlIEFsZXJ0YXM6IGluZm8sIGVycm9yLCB3YXJuaW5nLCBzdWNjZXNzCiAqCiAqLwokX2FsZXJ0TWVuc2FnZW0gPSAnTWVuc2FnZW0gZG8gQWxlcnRhJzsKJF9hbGVydFRpcG8gPSAnaW5mbyc7IAptY19hbGVydE5vdGZpdCggJF9hbGVydE1lbnNhZ2VtLCAkX2FsZXJ0VGlwbyApOw==");
define('___MACRO_MODELO_ALERT_SWEET___', "LyoqCiAqIEFMRVJUQVMgRE8gU0lTVEVNQSBFTSBTV0VFVCBBTEVSVAogKgogKiBUaXBvcyBkZSBBbGVydGFzOiBlcnJvciwgd2FybmluZywgc3VjY2VzcwogKgogKi8KJF9hbGVydFRpdHVsbyA9ICdUaXR1bG8gZGEgTWVuc2FnZW0nOyAKJF9hbGVydE1lbnNhZ2VtID0gJ01lbnNhZ2VtIGRvIEFsZXJ0YSc7CiRfYWxlcnRUaXBvID0gJ3N1Y2Nlc3MnOyAKbWNfYWxlcnRTd2VldCgkX2FsZXJ0VGl0dWxvLCAkX2FsZXJ0TWVuc2FnZW0sICRfYWxlcnRUaXBvKTsK");
define('___MACRO_MODELO_ALERT_TOAST___', "LyoqCiAqIEFMRVJUQVMgRE8gU0lTVEVNQSBFTSBUT0FTVFIKICoKICogVGlwb3MgZGUgQWxlcnRhczogaW5mbywgd2FybmluZywgZXJyb3IsIHN1Y2Nlc3MKICoKICogUG9zacOnw6NvIDogdG9wLWxlZnQsIHRvcC1jZW50ZXIsIHRvcC1yaWdodCwgYm90dG9tLWxlZnQsIGJvdHRvbS1jZW50ZXIsIGJvdHRvbS1yaWdodAogKi8KJF9hbGVydFRpdHVsbyA9ICdUaXR1bG8gZGEgTWVuc2FnZW0nOyAKJF9hbGVydE1lbnNhZ2VtID0gJ01lbnNhZ2VtIGRvIEFsZXJ0YSc7CiRfYWxlcnRUaXBvID0gJ2luZm8nOyAKJF9hbGVydFBvc2l0aW9uID0gJ3RvcC1jZW50ZXInOwptY19hbGVydFRvYXN0KCRfYWxlcnRUaXR1bG8sICRfYWxlcnRNZW5zYWdlbSwgJF9hbGVydFRpcG8sICRfYWxlcnRQb3NpdGlvbik7Cgo=");
define('___MACRO_MODELO_ALERT_BOOTSTRAP_DEFAULT___', "LyoqCiAqIFNFVEEgT1MgQUxFUlRBUyBETyBTSVNURU1BIEVNIEJPT1RTVFJBUCBERUZBVUxUCiAqCiAqIFRpcG9zIGRlIEFsZXJ0YXM6IGRhbmdlciwgd2FybmluZywgc3VjY2VzcywgaW5mbwogKgogKi8KJF9hbGVydFRpdHVsbyA9ICdUw610dWxvIGRhIE1lbnNhZ2VtLic7CiRfYWxlcnRJY29uID0gJ2ZhLXRodW1icy11cCc7CiRfYWxlcnRNZW5zYWdlbSA9ICdNZW5zYWdlbSBkbyBBbGVydGEuJzsKJF9hbGVydFRpcG8gPSAnaW5mbyc7IAptY19hbGVydCgkX2FsZXJ0VGl0dWxvLCAkX2FsZXJ0TWVuc2FnZW0sICRfYWxlcnRJY29uLCAkX2FsZXJ0VGlwbyk7Cgo=");
define('___MACRO_MODELO_SEND_MAIL___', "LyoqCiAqIE1BQ1JPIFNFTkQgTUFJTAogKgogKiAkX3NlbmRNYWlsVG8gICAgICAgICAgICAgICAgUGFyYSBxdWVtIHZhaSBzZXIgbWFuZGFkbyBlc3RlIGVtYWlsIC0gREVTVElOTwogKiAkX3NlbmRNYWlsU3ViamVjdCAgICAgICAgIFF1YWwgbyBhc3N1bnRvIGRvIGVtYWlsCiAqICRfc2VuZE1haWxNZXNzYWdlICAgICAgICBNZW5zYWdlbS9Db3JwbyBkbyBlbWFpbAogKiAkX3NlbmRNYWlsRm9ybWF0ICAgICAgICAgIFBvciBwYWRyw6NvIHNlcsOhIEhUTUwgLSBodG1sIG91IHRleHQKICovCiRfc2VuZE1haWxUbyA9ICdFTUFJTC1ERVNUSU5PJzsKJF9zZW5kTWFpbFN1YmplY3QgPSAnU3ViamVjdCBkbyBFbWFpbCc7CiRfc2VuZE1haWxNZXNzYWdlID0gJ0NvcnBvIGRvIEVtYWlsJzsKJF9zZW5kTWFpbEZvcm1hdCA9ICdodG1sJzsKJF9yZXN1bHRTZW5kTWFpbCA9IG1jX3NlbmRfbWFpbCgkX3NlbmRNYWlsVG8sICRfc2VuZE1haWxTdWJqZWN0LCAkX3NlbmRNYWlsTWVzc2FnZSwgJF9zZW5kTWFpbEZvcm1hdCk7CgppZiggJF9yZXN1bHRTZW5kTWFpbCApewogICAgIC8qKgogICAgICAqIEFMRVJUQVMgRE8gU0lTVEVNQSBFTSBOT1RGSVQgTUVTU0VOR0VSCiAgICAgICoKICAgICAgKiBUaXBvcyBkZSBBbGVydGFzOiBpbmZvLCBlcnJvciwgd2FybmluZywgc3VjY2VzcwogICAgICAqCiAgICAgICovCiAgICAgJF9hbGVydE1lbnNhZ2VtID0gJ0VtYWlsIGVudmlhZG8gY29tIHN1Y2Vzc28uJzsKICAgICAkX2FsZXJ0VGlwbyA9ICdpbmZvJzsgCiAgICAgbWNfYWxlcnROb3RmaXQoICRfYWxlcnRNZW5zYWdlbSwgJF9hbGVydFRpcG8gKTsKfQ==");
define('___MACRO_MODELO_ARRAY_FILTER_FIELD___', "LyoqCiAqIEZJTFRSQSBPIENPTlRFw5pETyBERSBVTSBBUlJBWSBQT1IgVU0gQ0FNUE8gRVNQRUPDjUZJQ08uCiAqCiAqICRfZmlsdGVyQXJyYXlbJ2FycmF5J10gICAgICAgICAgICBQYXNzYSBvIEFSUkFZIHBhcmEgc2VyIGZpbHRyYWRvCiAqICRfZmlsdGVyQXJyYXlbJ2ZpZWxkJ10gICAgICAgICAgICAgIFBhc3NhIG8gTk9NRSBETyBDQU1QTyBxdWUgY29udMOpbSBvIHZhbG9yIGEgc2VyIGZpbHRyYWRvCiAqICRfZmlsdGVyQXJyYXlbJ3ZhbHVlJ10gICAgICAgICAgICBQYXNzYSBvIFZBTE9SIGRvIENBTVBPIGEgc2VyIGZpbHRyYWRvCiAqICRfZmlsdGVyQXJyYXlbJ2xpa2VfdmFsdWUnXSAgICAgWSA9IFNlIGNvbnTDqW0gYSBvY29ycsOqbmNpYSBlbSBxdWFscXVlciBwYXJ0ZSBkbyBjYW1wbyBvdSBOID0gUHJvY3VyYSBwZWxvIHZhbG9yIGV4YXRvIGRhIG9jb3Jyw6puY2lhIG5vIGNhbXBvCiAqCiAqLwokX2ZpbHRlckZpZWxkQXJyYXlbJ2FycmF5J10gPSAgJ1NFVS1BUlJBWS1ERS1EQURPUy1BUVVJJzsKJF9maWx0ZXJGaWVsZEFycmF5WydmaWVsZCddID0gJ05PTUUtRE8tQ0FNUE8tQVFVSSc7CiRfZmlsdGVyRmllbGRBcnJheVsndmFsdWUnXSA9ICdWQUxPUi1QQVJBLVBFU1FVSVNBUic7CiRfZmlsdGVyRmllbGRBcnJheVsnbGlrZV92YWx1ZSddICA9ICdZJzsKIAokX3IgPSBtY19maWx0ZXJfZmllbGRfYXJyYXkoICRfZmlsdGVyRmllbGRBcnJheSApIDs");
define('___MACRO_MODELO_ARRAY_FILTER_LIKE___', "LyoqCiAqIEZJTFRSQSBPIENPTlRFw5pETyBERSBVTSBBUlJBWSBRVUUgQ09OVEVOSEEgVU1BIE9DT1JSw4pOQ0lBIEVNIFFVQUxRVUVSIENBTVBPIERPIEFSUkFZLgogKiAKICogJF9maWx0ZXJBcnJheVsnYXJyYXknXSAgICAgUGFzc2EgbyBBUlJBWSBwYXJhIHNlciBmaWx0cmFkbwogKiAkX2ZpbHRlckFycmF5Wyd2YWx1ZSddICAgICBQYXNzYSBvIFZBTE9SIGEgc2VyIHBlc3F1aXNhZG8gZGVudHJvIGRvIEFSUkFZCiAqCiAqLwokX2ZpbHRlckFycmF5WydhcnJheSddID0gJ1NFVS1BUlJBWS1ERS1EQURPUy1BUVVJJzsKJF9maWx0ZXJBcnJheVsndmFsdWUnXSA9ICdWQUxPUi1QQVJBLVBFU1FVSVNBUic7CiRfciA9IG1jX2ZpbHRlcl9saWtlX2FycmF5KCRfZmlsdGVyQXJyYXlbJ2FycmF5J10sICRfZmlsdGVyQXJyYXlbJ3ZhbHVlJ10pOw==");
define('___MACRO_MODELO_ARRAY_CASE_SENSITIVE___', "LyoqCiAqIEFMVEVSQVIgUEFSQSBNQUnDmlNDVUxPIE9VIE1JTsOaU0NVTE8gT1MgVkFMT1JFUyBETyBBUlJBWSBSRUNVUlNJVkFNRU5URSAoU1VQT1JUQSBVVEY4IC8gTVVMVElCWVRFKQogKiAKICogUHLDom1ldHJvczogKENBU0VfTE9XRVI6IHBhcmEgbWluw7pzY3VsbyB8IENBU0VfVVBQRVI6IHBhcmEgbWFpw7pzY3VsbykKICogCiAqIEBwYXJhbSBhcnJheSAkYXJyYXkgVGhlIGFycmF5CiAqIEBwYXJhbSBpbnQgJGNhc2UgQ2FzZSB0byB0cmFuc2Zvcm0gKENBU0VfTE9XRVIgfCBDQVNFX1VQUEVSKQogKiBAcmV0dXJuIGFycmF5IEZpbmFsIGFycmF5CiAqIEByZXR1cm4gYXJyYXkKICovCiRfY2FzZVNlbnNpdGl2ZUFycmF5WydhcnJheSddID0gU0VVLUFSUkFZLUFRVUk7CiRfY2FzZVNlbnNpdGl2ZUFycmF5WydjYXNlJ10gPSBDQVNFX0xPV0VSOwokX3Jlc3VsdENhc2VTZW5zaXRpdmVBcnJheT0gbWNfY2hhbmdlX3ZhbHVlc19jYXNlX2FycmF5KCRfY2FzZVNlbnNpdGl2ZUFycmF5WydhcnJheSddLCAkX2Nhc2VTZW5zaXRpdmVBcnJheVsnY2FzZSddKTs=");
define('___MACRO_MODELO_ARRAY_EXCLUDE_FIELD___', "LyoqCiAqIEVYQ0xVSSBVTSBPVSBNQUlTIENBTVBPUyBERSBVTSBBUlJBWQogKgogKiAkX2V4Y2x1ZGVGaWVsZEFycmF5WydhcnJheSddICAgICBQYXNzYSBvIGFycmF5IGNvbSBvcyBkYWRvcy4KICogJF9leGNsdWRlRmllbGRBcnJheVsnZmllbGRzJ10gICAgIE5vbWUgZGFzIENvbHVuYXMvQ2FtcG9zIGRvIGFycmF5IHF1ZSBzZXLDo28gZXhsdWlkYXMuIEVYOiBhcnJheSgnZmllbGQtMScsJ2ZpZWxkLTInLCdmaWVsZC0zJyk7ICAgICAKICovCiRfZXhjbHVkZUZpZWxkQXJyYXlbJ2FycmF5J10gPSBTRVUtQVJSQVktQ09NLU9TLURBRE9TLUFRVUkKJF9leGNsdWRlRmllbGRBcnJheVsnZmllbGRzJ10gPSBTRVUtQVJSQVktQ09NLU9TLUNBTVBPUy1BUVVJCiRfciA9IG1jX2V4Y2x1ZGVfY29sdW1uX2FycmF5KCRfZXhjbHVkZUZpZWxkQXJyYXlbJ2FycmF5J10sJF9leGNsdWRlRmllbGRBcnJheVsnZmllbGRzJ10pOw==");


/* DIVERSOS */
define('___MACRO_DIVERSOS_FARMAT_DATE___', "LyoqCiAqIENPTlZFUlRFIERBVEEgUEFSQSBPIFBBRFJBzINPIFFVRSBGT1IgUEFTU0FETyBOTyBQQVJBTUVUUk8KICoKICogRXhlbXBsbyA6IG1jX2Zvcm1hdF9kYXRlKERBVEEsJ2QvbS9ZIEg6aTpzJyk7CiAqCiAqICRfZGF0ZSAgIFBhc3NhIHVtIHN0cmluZyBjb20gYSBkYXRhCiAqICRfbWFzYyAgQ29tbyBhIGRhdGEgc2Vyw6EgZm9ybWF0YWRhLiBFeGVtcGxvOiAnZC9tL1kgSDppOnMnCiAqLwoKJF9kYXRlID0gJyc7CiRfbWFzYyA9ICdkL20vWSBIOmk6cyc7CiRfcmVzdWx0ID0gbWNfZm9ybWF0X2RhdGUoICRfZGF0ZSwgJF9tYXNjICk7");
define('___MACRO_DIVERSOS_MONTH_DATE___', "LyoKICogTUFDUk8gUVVFIFJFVE9STkEgTyBNw4pTIERFIFVNQSBEQVRBCiAqCiAqIFNlICRfZXh0ZW5zaXZlID0gVFJVRSwgcmV0b3JuYSBvIG3DqnMgcG9yIGV4dGVuc28uCiAqCiAqICRfZGF0ZSAgICAgICAgICAgICAgICAgSW5mb3JtZSB1bWEgZGF0YQogKiAkX2V4dGVuc2l2ZSAgICAgICAgIFRSVUUgcGFyYSByZXRvcm5hciBNw6pzIHBvciBleHRlbmRvLCBGQUxTRSBwYXJhIHJldG9ybmFyIG8gbsO6bWVybyBkbyBNw6pzCiAqIAogKi8KIAokX2RhdGUgPSAnJzsKJF9leHRlbnNpdmUgPSBUUlVFOwokX3Jlc3VsdCA9ICBtY19tb250aF9kYXRlKCAkX2RhdGUsICRfZXh0ZW5zaXZlICk7Cg==");
define('___MACRO_DIVERSOS_CALC_DATE_DIFF___', "LyoqCiAqIEVTVEEgTUFDUk8gQ0FMQ1VMQSBBIERJRkVSRU5DzKdBIEVOVFJFIERBVEFTLCBFTSBRVUFOVElEQURFIERFIERJQVMuCiAqIEFTIERBVEFTIERFVkVNIFNFUiBDT01QT1NUQVMgREUgRElBLCBNRcyCUyBFIEFOTy4KICovCiRfZGF0ZTEgPSAnJyA7CiRfZGF0ZTIgPSAnJzsKCiRfciA9IG1jX2NhbGNfZGF0ZV9kaWZmKCAkX2RhdGUxICwgJF9kYXRlMiApOw==");
define('___MACRO_DIVERSOS_CALC_TIME_DIFF___', "LyoqCiAqIEVTU0EgTUFDUk8gQ0FMQ1VMQSBBIERJRkVSRU5DzKdBIEVOVFJFIERPSVMgVkFMT1JFUyBETyBUSVBPIERBVEVUSU1FIEUgUkVUT1JOQSBPIFJFU1VMVEFETyBFTSBGT1JNQVRPIERFIEhPUkFTLgogKiBBUyBEQVRBUyBERVZFTSBTRVIgQ09NUE9TVEFTIERFIERJQSwgTcOKUywgQU5PLCBIT1JBLCBNSU5VVE8gRSBTRUdVTkRPLiBFWC4gJzIwMTUvMDQvMTUgMDA6MDA6MDAnCiAqLwokX2RhdGF0aW1lMSA9ICcnOwokX2RhdGF0aW1lMiA9ICcnOwoKJF9yID0gbWNfY2FsY190aW1lX2RpZmYoJF9kYXRhdGltZTEsICRfZGF0YXRpbWUyKTs=");
define('___MACRO_DIVERSOS_EXTENSIVE_VALUE___', "LyoKICogTUFDUk8gUVVFIFJFVE9STkEgVkFMT1IgUE9SIEVYVEVOU08uCiAqCiAqICRfdmFsdWUgICAgICAgICAgICAgICAgICAgICBVbSB2YWxvcgogKiAkX3Nob3dfY2VudHMgICAgICAgICAgICBUUlVFIG1vc3RyYSB2YWxvciBkb3MgY2VudGF2b3MgcG9yIGV4dGVuc28KICogJF9mZW1pbmluZV93b3JkICAgICAgIFRSVUUgbW9zdHJhIHBhbGF2cmEgbm8gZmVtaW5pbm8KICoKICogQWxndW5zIGV4ZW1wbG9zIGRlIHVzbyBkYSBtYWNybzoKICoKICogLy9WYWkgZXhpYmlyIG5hIHRlbGEgJ3VtIG1pbGjDo28sIHF1YXRyb2NlbnRvcyBlIG9pdGVudGEgZSBzZXRlIG1pbCwgZHV6ZW50b3MgZSBjaW5xdWVudGEgZSBzZXRlIGUgY2lucXVlbnRhIGUgY2luY28nCiAqIGVjaG8gbWNfZXh0ZW5zaXZlX3ZhbHVlKCcxLjQ4Ny4yNTcsNTUnLCBmYWxzZSwgZmFsc2UpOwogKgogKiAvL1ZhaSBleGliaXIgbmEgdGVsYSAndW0gbWlsaMOjbywgcXVhdHJvY2VudG9zIGUgb2l0ZW50YSBlIHNldGUgbWlsLCBkdXplbnRvcyBlIGNpbnF1ZW50YSBlIHNldGUgcmVhaXMgZSBjaW5xdWVudGEgZSBjaW5jbyBjZW50YXZvcycKICogZWNobyB2YWxvclBvckV4dGVuc28oJzEuNDg3LjI1Nyw1NScsIHRydWUsIGZhbHNlKTsKICoKICogLy9WYWkgZXhpYmlyIG5hIHRlbGEgJ2R1YXMgbWlsIGUgc2V0ZWNlbnRhcyBlIG9pdGVudGEgZSBzZXRlJwogKiBlY2hvIG1jX2V4dGVuc2l2ZV92YWx1ZSgnMjc4NycsIGZhbHNlLCB0cnVlKTsKICovCiRfdmFsdWUgPScnOwokX3Nob3dfY2VudHMgPSBUUlVFOwokX2ZlbWluaW5lX3dvcmQgPSBGQUxTRTsKJF9yZXN1bHQgPSBtY19leHRlbnNpdmVfdmFsdWUoJF92YWx1ZSAsICRfc2hvd19jZW50cywgJF9mZW1pbmluZV93b3JkICk7Cg==");
define('___MACRO_DIVERSOS_CONTAINS_STRING___', "LyoqCiAqIFBFU1FVSVNBIFVNIE9DT1JSw4pOQ0lBIERFTlRSTyBERSBVTUEgU1RSSU5HCiAqIAogKiBVc2FuZG8gYSBhbmFsb2dpYSBkZSBlbmNvbnRyYXIgdW1hIGFndWxoYSBlbSB1bSBwYWxoZWlyby4KICogCiAqICRfYWd1bGhhICAgICAgQWd1bGhhIC0gTyBxdcOqIHZjIGRlc2VqYSBlbmNvbnRyYXIKICogJF9wYWxoZWlybyAgICBQYWxoZWlybyAtIE9uZGUgdm9jw6ogZGVzZWphIGVuY29udHJhcgogKiAKICovCiRfYWd1bGhhICAgPSAnJzsKJF9wYWxoZWlybyA9ICcnOwokX3Jlc3VsdCA9IG1jX2NvbnRhaW5zX2luX3N0cmluZygkX2FndWxoYSwgJF9wYWxoZWlybyk7Cg==");
define('___MACRO_DIVERSOS_LIMIT_CHARS___', "LyoKICogTUFDUk8gTElNSVRBIEEgUVVBTlRJREFERSBERSBDQVJBQ1RFUkVTIEEgU0VSRU0gQVBSRVNFTlRBRE9TCiAqCiAqICRfc3RyaW5nICAgIFVNIFRFWFRPIFFVQUxRVUVSCiAqICRfbGltaXQgICAgICBMSU1JVEUgREEgUVVBTlRJREFERSBERSBDQVJBQ1RFUkVTCiAqICRfcG9pbnRlciAgQ0FSQUNURVJFUyBOTyBGSU5BTCBEQSBTVFJJTkcKICovCiRfc3RyaW5nPSAnc2V1IHRleHRvIGFxdWknOwokX2xpbWl0PSAxMDsKJF9wb2ludGVyPSAnLi4uJzsKCiRfcmVzdWx0ID0gbWNfbGltaXRfY2hhcnMoJF9zdHJpbmcsJF9saW1pdCwkX3BvaW50ZXIpOwoKCgo=");
define('___MACRO_DIVERSOS_LIMIT_WORDS___', "LyoKICogTUFDUk8gTElNSVRBIEEgUVVBTlRJREFERSBERSBQQUxBVlJBUyBBIFNFUkVNIEFQUkVTRU5UQURBUwogKgogKiAkX3N0cmluZyAgICBVTSBURVhUTyBRVUFMUVVFUgogKiAkX2xpbWl0ICAgICAgTElNSVRFIERBIFFVQU5USURBREUgREUgUEFMQVZSQVMKICogJF9wb2ludGVyICBDQVJBQ1RFUkVTIE5PIEZJTkFMIERBIFNUUklORwogKi8KJF9zdHJpbmcgPSAnc2V1IHRleHRvIGFxdWknOwokX2xpbWl0ID0gMjsKJF9wb2ludGVyID0gJy4uLic7CgokX3Jlc3VsdCA9IG1jX2xpbWl0X3dvcmRzKCRfc3RyaW5nLCRfbGltaXQsJF9wb2ludGVyKTsKCgoK");
define('___MACRO_DIVERSOS_FORMAT_MOEDA___', "LyoqCiAqIE1BQ1JPIFBBUkEgRk9STUFUQcOHw4NPIERFIFZBTE9SRVMKICogCiAqICRfdmFsb3IgICAgICAgICAgICAgIFZhbG9yIHBhcmEgZm9ybWF0YcOnw6NvCiAqICRfZGVjaW1hbCAgICAgICAgICBRdWFudGlkYWRlIGRlIGNhc2FzIGRlY2ltYWlzCiAqICRfbGFuZyAgICAgICAgICAgICAgIGJyID0gVmFsb3IgcGFkcsOjbyBCcmFzaWwgLSBlbiA9IFZhbG9yIHBhZHLDo28gQW1lcmljYW5vCiAqICRfY2lmcmFvICAgICAgICAgICAgIE51bGwgcGFyYSBuZW5odW0gb3UgaW5mb3JtYXIgbyBjaWZyw6NvIHJlZmVyZW50ZSBhIGZvcm1hdGHDp8Ojby4gRXg6IFIkIHBhcmEgUmVhbCBvdSBVJCBwYXJhIERvbGFyCiAqCiAqLwogCiRfdmFsb3IgPSAnMTAwMC4wMCc7CiRfZGVjaW1hbCA9ICcyJzsKJF9sYW5nID0gJ2JyJzsKJF9jaWZyYW8gPSAnUiQgJzsgCiAKJF9yZXN1bHQgPSBtY19mb3JtYXRfbW9lZGEoICRfdmFsb3IsICAkX2RlY2ltYWwsICRfbGFuZywgJF9jaWZyYW8gKTs=");

define('___MACRO_DIVERSOS_FORMAT_CPF_CNPJ___', "LyoqDQogKiBFU1RBIE1BQ1JPIEZBWiBBIEZPUk1BVEHDh8ODTyBERSBDUEYvQ05QSi4gDQogKiBFeDogQ1BGOiA5OTkuOTk5Ljk5OS05OSAtIENOUEo6IDk5Ljk5OS45OTkvOTk5OS05OQ0KICovDQokX2NwZl9jbnBqID0gJyc7Ly9JbmZvcm1lIHNldSBDUEYgb3UgQ05QSg0KJF9jcGZfY25waiA9IG1jX2Zvcm1hdF9jcGZfY25waiggJF9jcGZfY25waiApOw==");

define('___MACRO_DIVERSOS_RANDOM_STRING___', "LyoqCiAqIE1BQ1JPIFFVRSBHRVJBIFVNQSBTVFJJTkcgUkFORE9NSUNBLgogKgogKiAkX2NoYXJzX21pbiAgICAgICAgICAgICAgICAgICAgIE3DrW5pbW8gZGUgY2FyYWN0ZXJlcyBhIHNlciBnZXJhZG8KICogJF9jaGFyc19tYXggICAgICAgICAgICAgICAgICAgIE3DoXhpbW8gZGUgY2FyYWN0ZXJlcyBhIHNlciBnZXJhZG8KICogJF91cHBlcl9jYXNlICAgICAgICAgICAgICAgICAgIFJldG9ybmEgY2FyYWN0ZXJlcyBtYWl1c2xvcyBvdSBtaW51c2N1bG9zCiAqICRfaW5jbHVkZV9sZXR0ZXIgICAgICAgICAgICAgICAgU2UgdmFpIHRlciBsZXRyYXMgbmEgc3RyaW5nCiAqICRfaW5jbHVkZV9udW1iZXJzICAgICAgICAgICBTZSB2YWkgdGVyIG7Dum1lcm9zIG5hIHN0cmluZwogKiAkX2luY2x1ZGVfc3BlY2lhbF9jaGFycyAgICBTZSB2YWkgdGVyIGNhcmFjdGVyZXMgZXNwZWNpYWlzIG5hIHN0cmluZwogKgogKi8KCiRfY2hhcnNfbWluID0gJzYnOwokX2NoYXJzX21heCA9ICc2JzsKJF91cHBlcl9jYXNlID0gRkFMU0U7CiRfaW5jbHVkZV9sZXR0ZXIgPSBGQUxTRTsKJF9pbmNsdWRlX251bWJlcnMgPSBUUlVFOwokX2luY2x1ZGVfc3BlY2lhbF9jaGFycyA9IEZBTFNFOwogCiRfcmVzdWx0ID0gbWNfcmFuZG9tX251bWJlciggJF9jaGFyc19taW4sICRfY2hhcnNfbWF4LCAkX3VwcGVyX2Nhc2UsICRfaW5jbHVkZV9sZXR0ZXIsICRfaW5jbHVkZV9udW1iZXJzLCAkX2luY2x1ZGVfc3BlY2lhbF9jaGFycyApOwo=");
define('___MACRO_DIVERSOS_FILL_STRING___', "LyoqCiAqIE1BQ1JPIFFVRSBQUkVFTkNIRSBVTUEgU1RSSU5HIENPTSBDQVJBQ1RFUkVTCiAqIAogKiAkX3N0cmluZyAgICAgICAgICAgICBQYXNzYSBhIHN0cmluZyBjb20gb3MgZGFkb3MKICogJF9vcmllbnRhY2FvICAgICAgRXNxdWVyZGEgTEVGVCwgRGlyZXRpYSBSSUdIVC4gUG9yIHBhZHLDo28gc2Vyw6EgTEVGVAogKiAkX2NhcmFjdGVyICAgICAgICAgUXVhbCBvIHRpcG8gZGUgY2FyYWN0YXIgcXVlIHNlcsOhIGFkaWNpb25hZG8gYSBTdHJpbmcuIFBvciBwYWRyw6NvIHNlcsOhICoKICogJF9xdWFudGlkYWRlICAgICBRdWFudGlkYWRlIGRlIGNhcmFjdGFyIHF1ZSBzZXLDoSBhZGljaW9uYWRvIGEgU3RyaW5nCiAqLwogCiRfc3RyaW5nID0gJzEwMCc7CiRfb3JpZW50YWNhbyA9ICdSSUdIVCc7CiRfY2FyYWN0ZXIgPSAnKic7CiRfcXVhbnRpZGFkZSA9ICcxMCc7CiAKJF9yZXN1bHQgPSBtY19maWxsX3N0cmluZyggJF9zdHJpbmcsICRfb3JpZW50YWNhbywgJF9jYXJhY3RlciwgJF9xdWFudGlkYWRlICk7CgoKCg==");
define('___MACRO_DIVERSOS_REDIRECT_APP___', "LyoqCiAqIE1BQ1JPIFJFRElSRUNUCiAqIAogKiAkX2FwcCAgICAgICAgTm9tZSBkbyBBUFAgcGFyYSBvbmRlIHNlcsOhIHJlZGlyZWNpb25hZG8KICogJF9wYXJhbSAgICBQYXLDom1ldHJvcyBwYXJhIGRvIHJlZGlyZWNpb25hbWVudG8uIEV4LiBzZWFyY2g9bm9tZSZmaWVsZD10ZXh0IG91IE5VTEwgcGFyYSBuZW5odW0KICovCiRfYXBwID0gJyc7CiRfcGFyYW0gPSAnc2VhcmNoPSc7Cm1jX3JlZGlyZWN0KCAkX2FwcCwgJF9wYXJhbSApIDs=");
define('___MACRO_DIVERSOS_PARAMETERS_URL___', "LyoqCiAqIE1BQ1JPIFFVRSBQRUdBIE9TIFBBUsOCTUVUUk9TIERBIFVSTAogKgogKi8KJF9yID0gbWNfZ2V0X3BhcmFtZXRlcnNfdXJsKCk7");
define('___MACRO_DIVERSOS_VAR_DUMP___', "ZWNobyAnPHByZSBjbGFzcz1cJ3ZhcmR1bXBcJz4nOwp2YXJfZHVtcCggJF9yZXN1bHQgKTsKZWNobyAnPC9wcmU+JzsKZXhpdDs=");


/**
 * JS
 */
/* AJAX POST */
define('___MACRO_JS_AJAX_POST___', '');

/* BUTTONS */
define('___MACRO_JS_BUTTONS_GRIDLIST___', 'LyoqCiAqIE1BQ1JPIEFERCBCVVRUT04gTkEgQkFSUkEgREUgTUVOVVMgREEgR1JJRCBMSVNUCiAqLwp2YXIgX2Z1bmN0aW9uID0gJ2Zjbi1tYWNyby1idG4nOwp2YXIgX2J0bl9lbmFibGVfbWFyayA9ICdidG4tZW5hYmxlLWdyaWRsaXN0LWNoZWNrYm94LW1hcmsgZGlzYWJsZWQnOwp2YXIgX2J0bl90eXBlID0gJ2J0bi1kZWZhdWx0JzsKdmFyIF9idG5fdGV4dCA9ICc8aSBjbGFzcz1cJ2ZhIGZhLWNoZWNrIG1hcmdpbi1yaWdodC01XCc+PC9pPk1BQ1JPIEJUTic7CgokKCcuYnRuLWdyb3VwIC5pbnB1dC1ncm91cC1idG4nKS5hcHBlbmQoJzxidXR0b24gdHlwZT1cJ2J1dHRvblwnIGNsYXNzPVwnYnRuICcrX2J0bl90eXBlKycgYnRuLXNtIG1hcmdpbi1sZWZ0LTUgJytfZnVuY3Rpb24rJyAnK19idG5fZW5hYmxlX21hcmsrJ1wnPicrX2J0bl90ZXh0Kyc8L2J1dHRvbj4nKTsgCgokKCcuJytfZnVuY3Rpb24pLm9uKCdjbGljaycsZnVuY3Rpb24oKXsKICAgICBhbGVydCgnQXF1aS4uLicpOwp9KTsKCgoKCgoKCgo=');
define('___MACRO_JS_BUTTONS_FORM_ADD_EDIT___', 'LyoqCiAqIE1BQ1JPIEFERCBCVVRUT04gTkEgQkFSUkEgREUgTUVOVVMgRE8gRk9STSBBREQvRURJVAogKi8KdmFyIF9mdW5jdGlvbiA9ICdmY24tbWFjcm8tYnRuJzsKdmFyIF9idG5fdHlwZSA9ICdidG4tZGVmYXVsdCc7CnZhciBfYnRuX3RleHQgPSAnPGkgY2xhc3M9XCdmYSBmYS1jaGVjayBtYXJnaW4tcmlnaHQtNVwnPjwvaT5NQUNSTyBCVE4nOwoKJCgnLmlucHV0LWdyb3VwLWJ0bicpLmFwcGVuZCgnPGJ1dHRvbiB0eXBlPVwnYnV0dG9uXCcgY2xhc3M9XCdidG4gJytfYnRuX3R5cGUrJyBidG4tc20gbWFyZ2luLWxlZnQtNSAnK19mdW5jdGlvbisnXCc+JytfYnRuX3RleHQrJzwvYnV0dG9uPicpOyAKCiQoJy4nK19mdW5jdGlvbikub24oJ2NsaWNrJyxmdW5jdGlvbigpewogICAgIGFsZXJ0KCdBcXVpLi4uJyk7Cn0pOwoKCgoKCgoKCg==');

/* JQUERY MASK */
define('___MACRO_JS_REMOVE_JQUERY_MASK_ON_SAVE_OR_EDIT___', 'LyoqDQogKiBNQUNSTyBSRU1PVkUgTUFTQ0FSQSBETyBJTlBVVCBOTyBPTiBTQVZFL0VESVQNCiAqLw0KICQoJyNidG4tc2FsdmFyLCAjYnRuLWVkaXRhcicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCkgew0KICAgICQoJy5DTEFTU19ET19FTEVOVE9fQVFVSScpLnJlbW92ZUNsYXNzKCdDTEFTU19ET19FTEVOVE9fQVFVSScpLnVubWFzaygpOw0KfSk7DQoNCg0KIA==');

/* SEARCH BAR ELEMENT */
define('___MACRO_JS_SEARCH_BAR_ELEMENT_GRIDLIST___', 'LyoqCiAqIFNFQVJDSCBCQVIgRUxFTUVOVAogKi8KJCgnI2J1dHRvbnMtbG9vc2UtYWZ0ZXItaW5wdXRzZWFyY2gnKS5hcHBlbmQoICcgQU5URVMgJyApOwokKCcjYnV0dG9ucy1sb29zZS1iZWZvcmUtaW5wdXRzZWFyY2gnKS5hcHBlbmQoICcgREVQT0lTICcgKTsKCgoKCgoKCgo=');

/* MODAL */
define('___MACRO_JS_OPEN_MODAL___', 'LyoqCiAqIE1BQ1JPIE9QRU4gTU9EQUwKICovCiB2YXIgX21vZGFsTmFtZSA9ICdub21lRGFNb2RhbEFxdWknOwogJCgnI2J6TW9kYWwnK19tb2RhbE5hbWUpLm1vZGFsKCdzaG93Jyk7');
define('___MACRO_JS_CLOSE_MODAL___', 'LyoqCiAqIE1BQ1JPIENMT1NFIE1PREFMCiAqLwogdmFyIF9tb2RhbE5hbWUgPSAnbm9tZURhTW9kYWxBcXVpJzsKICQoJyNiek1vZGFsJytfbW9kYWxOYW1lKS5tb2RhbCgnaGlkZScpOw==');

/* ALERTS */
define('___MACRO_JS_ALERT_SWEET_ALERT___', 'LyogTUFDUk8gUVVFIEdFUkEgVU1BIE1FTlNBR0VNIFBPUFVQIFNXRUVUIEFMRVJUICovDQptY19zd2VldF9hbGVydCgNCiAgICAiVGl0dWxvIGRhIE1lbnNhZ2VtIiwNCiAgICAiTWVuc2FnZW0iLA0KICAgICJzdWNjZXNzIiAvKiBUaXBvcyBkZSBNZW5zYWdlbnM6IHN1Y2Nlc3MsIHdhcm5pbmcsIGVycm9yICovDQopOw0KDQovKiBUSU1FIFBBUkEgRkVDSEFSIEEgTUVOU0dBRU0gKi8NCnNldEludGVydmFsKGZ1bmN0aW9uICgpIHsNCiAgICAgc3dhbC5jbG9zZSgpOw0KfSwgMzAwMCk7');
define('___MACRO_JS_ALERT_NOTFIT___', 'LyogTUFDUk8gUVVFIEdFUkEgVU1BIE1FTlNBR0VNIE5PVElGSVQgKi8NCm1jX25vdGZpdF9hbGVydCgiIE1lbnNhZ2VtIGRlIFRlc3RlICIsICJpbmZvIik7LyogVGlwb3MgZGUgTWVuc2FnZW5zOiBpbmZvLCBzdWNjZXNzLCB3YXJuaW5nLCBlcnJvciAqLw==');
define('___MACRO_JS_ALERT_TOASTER___', 'LyoqDQogKiBNQUNSTyBBTEVSVEFTIERPIFNJU1RFTUEgRU0gVE9BU1RFUg0KICoNCiAqIFBvc2l0aW9uIDogdG9wLWxlZnQsIHRvcC1jZW50ZXIsIHRvcC1yaWdodCwgYm90dG9tLWxlZnQsIGJvdHRvbS1jZW50ZXIsIGJvdHRvbS1yaWdodA0KICogVHlwZSAgICAgOiBpbmZvLCBzdWNjZXNzLCAgd2FybmluZywgZXJyb3INCiAqLw0KDQptY190b2FzdF9hbGVydCgiVGl0dWxvIiwgIjEgMiAzIFRleHRvIiwgInRvcC1jZW50ZXIiLCJpbmZvIik7');

/**
 * ========================================================================================================================================================================
 *  END MACRO CODE
 * ========================================================================================================================================================================
 */
