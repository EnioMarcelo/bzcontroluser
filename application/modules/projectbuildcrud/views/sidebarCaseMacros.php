<!--SIDEBAR CASE MACROS-->


<?php
/**
 * CÓDIGO DAS MACROS
 */
/* INSERT, UPDATE, DELETE */
define('___MACRO_DATABASE_INSERT___', "LyoqDQogKiBJTlNFUlQgREFUQSBJTlRPIFRBQkxFDQogKi8NCiRfaW5zZXJ0VGFibGUgPSAnTk9NRS1EQS1TVUEtVEFCRUxBJzsNCiRfZGFkb3NJbnNlcnRUYWJsZVsnY2FtcG8nXSA9ICdkYWRvcyBkbyBjYW1wbyc7DQoNCiRfcmVzdWx0RGFkb3NJbnNlcnRUYWJsZSA9IG1jX2luc2VydERhdGFEQigkX2luc2VydFRhYmxlLCAkX2RhZG9zSW5zZXJ0VGFibGUpOw0KDQppZiAoJF9yZXN1bHREYWRvc0luc2VydFRhYmxlKXsNCiAgICAgc2V0X21lbnNhZ2VtX25vdGZpdChfX19NU0dfQUREX1JFR0lTVFJPX19fLCAnc3VjY2VzcycpOw0KfWVsc2V7DQogICAgIGVjaG8gJ0Vycm8gYW8gaW5zZXJpciBEYWRvcy4nOw0KICAgICBleGl0Ow0KfQ0KLyogRU5EICBJTlNFUlQgREFUQSBJTlRPIFRBQkxFICov");
define('___MACRO_DATABASE_UPDATE___', "LyoqDQogKiBVUERBVEUgREFUQSBJTlRPIFRBQkxFDQogKi8NCiRfdXBkYXRlVGFibGUgPSAnTk9NRS1EQS1TVUEtVEFCRUxBJzsNCiRfd2hlcmVVcGRhdGVUYWJsZSA9ICdXSEVSRSBpZCA9IFwnU0VVLUlEXCcnOw0KJF9kYWRvc1VwZGF0ZVRhYmxlWydjYW1wbyddID0gJ2RhZG9zIGRvIGNhbXBvJzsNCg0KDQokX3Jlc3VsdERhZG9zVXBkYXRlVGFibGUgPSAkdGhpcy0+dXBkYXRlLT5FeGVjVXBkYXRlKCRfdXBkYXRlVGFibGUsICRfZGFkb3NVcGRhdGVUYWJsZSwgJF93aGVyZVVwZGF0ZVRhYmxlKTsNCg0KaWYgKCRfcmVzdWx0RGFkb3NVcGRhdGVUYWJsZSl7DQogICAgIHNldF9tZW5zYWdlbV9ub3RmaXQoX19fTVNHX0FERF9SRUdJU1RST19fXywgJ3N1Y2Nlc3MnKTsNCn1lbHNlew0KICAgICBlY2hvICdFcnJvIGFvIGF0dWFsaXphciBEYWRvcy4nOw0KICAgICBleGl0Ow0KfQ0KLyogRU5EICBVUERBVEUgREFUQSBJTlRPIFRBQkxFICov");
define('___MACRO_DATABASE_DELETE___', "LyoqDQogKiBERUxFVEUgREFUQSBJTlRPIFRBQkxFDQogKi8NCiRfZGVsZXRlVGFibGUgPSAnTk9NRS1EQS1TVUEtVEFCRUxBJzsNCiRfd2hlcmVEZWxldGVUYWJsZSA9ICdXSEVSRSBpZCA9IFwnU0VVLUlEXCcnOw0KDQokX3Jlc3VsdERhZG9zRGVsZXRlVGFibGUgPSAkdGhpcy0+ZGVsZXRlLT5FeGVjZGVsZXRlKCRfZGVsZXRlVGFibGUsICRfd2hlcmVEZWxldGVUYWJsZSk7DQoNCmlmICgkX3Jlc3VsdERhZG9zRGVsZXRlVGFibGUpew0KICAgICBzZXRfbWVuc2FnZW1fbm90Zml0KF9fX01TR19ERUxfUkVHSVNUUk9fX18sICdzdWNjZXNzJyk7DQp9ZWxzZXsNCiAgICAgZWNobyAnRXJybyBhbyBkZWxldGFyIERhZG9zLic7DQogICAgIGV4aXQ7DQp9DQovKiBFTkQgREVMRVRFIERBVEEgSU5UTyBUQUJMRSAqLw==");

/* AUDITORIA */
define('___MACRO_AUDITORIA_ADD___', "LyoqCiAqIE1BQ1JPIEdSQVZBIFVNQSBBVURJVE9SSUEKICoKICogJGRhZG9zQXVkaXRvcmlhWydhY3Rpb24nXSA9ICdhZGQnOyAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgUXVhbCBhw6fDo28gZm9pIGV4ZWN1dGFkYS4gRXg6IEFERCBxdWFuZG8gZmF6IHVtYSBpbmNsdXPDo28gZGUgcmVnaXN0cm8sIEVESVQgcXVhbmRvIGZheiBhbGd1bWEgYWx0ZXJhw6fDo28gbm8gcmVnaXN0cm8sIERFTCBxdWFuZG8gZXhjbHVpIHVtIHJlZ2lzdHJvCiAqICRkYWRvc0F1ZGl0b3JpYVsnZGVzY3JpcHRpb24nXSA9ICdNZW5zYWdlbSBkYSBBdWRpdG9yaWEnOyAgICAgIE1lbnNhZ2VtIHBhcmEgaW5mb3JtYXIgbyBtb3Rpdm8gZGEgQXVkaXRvcmlhCiAqLwokZGFkb3NBdWRpdG9yaWFbJ2FjdGlvbiddID0gJ2FkZCc7CiRkYWRvc0F1ZGl0b3JpYVsnZGVzY3JpcHRpb24nXSA9ICdNZW5zYWdlbSBkYSBBdWRpdG9yaWEnOwokX3IgPSBtY19hZGRfYXVkaXRvcmlhKCRkYWRvc0F1ZGl0b3JpYSk7");

/* FIND DATA IN TABLE */
define('___MACRO_ARRAY_FIND_ALL___', "LyoqDQogKiBTRUxFQ1QgQUxMIERBVEEgSU4gVEFCTEUNCiAqLw0KJF9maW5kQWxsVGFibGUgPSAnTk9NRS1EQS1TVUEtVEFCRUxBJzsNCiRfZmluZEFsbE9yZGVyQnlUYWJsZSA9ICdDQU1QT1MtUEFSQS1PUkRFTkHDh8ODTyc7DQoNCiRfcmVzdWx0RmluZHRBbGxUYWJsZSA9IG1jX2ZpbmRBbGxEYXRhREIoJF9maW5kQWxsVGFibGUsICRfZmluZEFsbE9yZGVyQnlUYWJsZSktPnJlc3VsdCgpOw0KDQovKiBFTkQgU0VMRUNUIEFMTCBEQVRBIElOIFRBQkxFICov");
define('___MACRO_ARRAY_FIND_BY_ID___', "LyoqDQogKiBTRUxFQ1QgQlkgSUQgREFUQSBJTiBUQUJMRQ0KICovDQokX2ZpbmRCeUlkVGFibGUgPSAnTk9NRS1EQS1TVUEtVEFCRUxBJzsNCiRfZmluZEJ5SWQ9ICdTRVUtSUQnOw0KDQokX3Jlc3VsdEZpbmRCeUlkVGFibGUgPSBtY19maW5kQnlJZERhdGFEQigkX2ZpbmRCeUlkVGFibGUsICRfZmluZEJ5SWQpLT5yb3coKTsNCg0KLyogRU5EIFNFTEVDVCBCWSBJRCBEQVRBIElOIFRBQkxFICovDQoNCg0KDQo=");
define('___MACRO_ARRAY_FIND_BY_FIELD___', "LyoqDQogKiBTRUxFQ1QgQlkgRklFTEQgREFUQSBJTiBUQUJMRQ0KICovDQokX2ZpbmRCeUZpZWxkVGFibGUgPSAnTk9NRS1EQS1TVUEtVEFCRUxBJzsNCiRfZmluZEJ5RmllbGQ9ICdOT01FLURPLUNBTVBPJzsNCiRfZmluZEJ5RmllbGRWYWx1ZSA9ICdWQUxPUi1ETy1DQU1QTyc7DQokX2ZpbmRCeUZpZWxkT3JkZXJCeSA9ICdDQU1QTy1QQVJBLU9SREVOQcOHw4NPJzsNCiRfZmluZEJ5RmllbGRMaWtlQ29uZGl0aW9uID0gVFJVRTsNCg0KJF9yZXN1bHRGaW5kQnlJZFRhYmxlID0gbWNfZmluZEJ5RmllbGREYXRhREIoJF9maW5kQnlGaWVsZFRhYmxlLCAkX2ZpbmRCeUZpZWxkLCAkX2ZpbmRCeUZpZWxkVmFsdWUsICgkX2ZpbmRCeUZpZWxkTGlrZUNvbmRpdGlvbiA/ICdsaWtlJyA6IE5VTEwpLCAkX2ZpbmRCeUZpZWxkT3JkZXJCeSktPnJlc3VsdCgpOw0KDQovKiBFTkQgU0VMRUNUIEJZIEZJRUxEIERBVEEgSU4gVEFCTEUgKi8NCg0KDQoNCg==");
define('___MACRO_ARRAY_FIND_WHERE_PARAM___', "LyoqDQogKiBTRUxFQ1QgV0hFUkUgUEFSQU0gREFUQSBJTiBUQUJMRQ0KICovDQokX2ZpbmRXaGVyZVRhYmxlID0gJ05PTUUtREEtU1VBLVRBQkVMQSc7DQokX2ZpbmRXaGVyZSA9IE5VTEw7IC8vIEV4OiBpZCA9IDEgQU5EIG5hbWUgPSAnYXJvbGRvJw0KJF9maW5kUGFyYW1bJ1NFVS1QQVLDgk1FVFJPJ10gPSAnTk9NRS1ETy1DQU1QTyc7IC8vIEV4OiAkX2ZpbmRGaW5kV2hlcmVQYXJhbVsnZGlzdGluY3QnXSA9ICduYW1lX2ZpZWxkJzsgb3UgJF9maW5kRmluZFdoZXJlUGFyYW1bJ2dyb3VwX2J5J10gPSAnbmFtZV9maWVsZF8xLG5hbWVfZmllbGRfMixuYW1lX2ZpZWxkXzMnOw0KDQokX3Jlc3VsdEZpbmRXaGVyZVBhcmFtID0gbWNfc2VsZWN0RGF0YURCKCAkX2ZpbmRXaGVyZVRhYmxlLCAoIWVtcHR5KCRfZmluZFdoZXJlKSA/ICRfZmluZFdoZXJlIDogJycpLCAoIWVtcHR5KCRfZmluZFBhcmFtKSA/ICRfZmluZFBhcmFtIDogJycpICktPnJlc3VsdCgpOw0KDQovKiBFTkQgU0VMRUNUIFdIRVJFIFBBUkFNIERBVEEgSU4gVEFCTEUgKi8NCg0KDQoNCg==");


/* MODELOS */
define('___MACRO_MODELO_MODAL___', "LyoqCiAqIE1PREFMCiAqIAogKiBQQVLDgk1FVFJPUyBEQSBNT0RBTAogKiAKICogbW9kYWxOYW1lICAgICAgICAgICAgICAgICAgICAgICBOb21lIGRhIE1vZGFsLCBzZSBuw6NvIGZvciBpbmZvcm1hZG8gbyBub21lIHBhZHLDo28gc2Vyw6EgYnpNb2RhbAogKiBtb2RhbENsYXNzQ3NzICAgICAgICAgICAgICAgICAgIFBhcmEgYWRpY2lvbmFyIHVtYSBjbGFzc2UgQ1NTIG5hIG1vZGFsCiAqIG1vZGFsU2l6ZSAgICAgICAgICAgICAgICAgICAgICAgICAgRGV0ZXJtaW5hIG8gdGFtYW5obyBkYSBtb2RhbCAtIEV4OiBsYXJnZSBwYXJhIEdyYW5kZSwgc21hbGwgcGFyYSBQZXF1ZW5vLiBTZSBuw6NvIGZvciBpbmZvcm1hZG8gbmFkYSBvIHRhbW5obyBwYWRyw6NvIHNlcsOhIE3DqWRpbwogKiBtb2RhbFRpdGxlICAgICAgICAgICAgICAgICAgICAgICAgICBPIFTDrXR1bG8gcGFyYSBhIE1vZGFsCiAqIG1vZGFsVGV4dCAgICAgICAgICAgICAgICAgICAgICAgICAgTyBUZXh0byBubyBjb3JwbyBkYSBNb2RhbAogKiBtb2RhbFRleHRTbWFsbCAgICAgICAgICAgICAgICAgIE8gVGV4dG8gZGUgdGFtYW5obyByZWR1emlubyBubyBjb3JwbyBkYSBNb2RhbAogKiBtb2RhbEJ0bkNsb3NlSWRDc3MgICAgICAgICAgICBJRCBkbyBib3TDo28gcXVlIGZlY2hhIGEgTW9kYWwKICogbW9kYWxCdG5Db25maXJtSWRDc3MgICAgICAgIElEIGRvIGJvdMOjbyBkZSBjb25maXJtYcOnw6NvIGRhIE1vZGFsCiAqIG1vZGFsQnRuQ2xvc2UgICAgICAgICAgICAgICAgICAgIFRleHRvIGRvIGJvdMOjbyBxdWUgZmVjaGEgYSBNb2RhbAogKiBtb2RhbEJ0bkNvbmZpcm0gICAgICAgICAgICAgICAgVGV4dG8gbyBib3TDo28gZGUgY29uZmlybWHDp8OjbyBkYSBNb2RhbAogKiBtb2RhbFNob3cgICAgICAgICAgICAgICAgICAgICAgICAgU2UgaW5mb3JtYWRvIGNvbW8gVFJVRSBhIE1vZGFsIMOpIGV4ZWN1dGFkYSBhdXRvbWF0aWNhbWVudGUKICogCiAqLwogCiRfY29uZmlnTW9kYWxbJ21vZGFsTmFtZSddID0gJ01vZGFsTmFtZScgOwokX2NvbmZpZ01vZGFsWydtb2RhbENsYXNzQ3NzJ10gPSAnbW9kYWxDbGFzc0NzcycgOwokX2NvbmZpZ01vZGFsWydtb2RhbFNpemUnXSA9ICcnIDsKJF9jb25maWdNb2RhbFsnbW9kYWxUaXRsZSddID0gJ1TDrXR1bG8gZGEgTW9kYWwnIDsKJF9jb25maWdNb2RhbFsnbW9kYWxUZXh0J10gPSAnVGV4dG8gZGEgTW9kYWwnIDsKJF9jb25maWdNb2RhbFsnbW9kYWxUZXh0U21hbGwnXSA9ICdUZXh0byBTbWFsbCBkYSBNb2RhbCcgOwokX2NvbmZpZ01vZGFsWydtb2RhbEJ0bkNsb3NlSWRDc3MnXSA9ICdpZEJ0bkNsb3NlJyA7CiRfY29uZmlnTW9kYWxbJ21vZGFsQnRuQ29uZmlybUlkQ3NzJ10gPSAnaWRCdG5Db25maXJtJyA7CiRfY29uZmlnTW9kYWxbJ21vZGFsQnRuQ2xvc2UnXSA9ICdGZWNoYXInIDsKJF9jb25maWdNb2RhbFsnbW9kYWxCdG5Db25maXJtJ10gPSAnT0snIDsKJF9jb25maWdNb2RhbFsnbW9kYWxTaG93J10gPSB0cnVlOyAKIAokdGhpcy0+ZGFkb3NbJ21vZGFsR3JpZExpc3QnXSA9IG1jX21vZGFsKCAkX2NvbmZpZ01vZGFsICk7Ci8vJHRoaXMtPmRhZG9zWydtb2RhbEZvcm1BZGQnXSA9IG1jX21vZGFsKCAkX2NvbmZpZ01vZGFsICk7Ci8vJHRoaXMtPmRhZG9zWydtb2RhbEZvcm1FZGl0J10gPSBtY19tb2RhbCggJF9jb25maWdNb2RhbCApOwo=");
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
define('___MACRO_DIVERSOS_VAR_DUMP___', "ZWNobyAnPHByZSBjbGFzcz1cJ3ZhcmR1bXBcJz4nOw0KdmFyX2R1bXAoICRfUE9TVCApOw0KZWNobyAnPC9wcmU+JzsNCmV4aXQ7");
define('___MACRO_DIVERSOS_CUT_WORDS___', "LyoKICogTUFDUk8gQ09SVEEgUEFMQVZSQVMgREUgVU1BIFNUUklORwogKgogKiBAcGFyYW0gJF9jdXJXb3JkU3RyaW5nQXJyYXlbJ3N0cmluZyddICAgICAgICAgICAgICAgVU1BIFZBUknDgVZFTCBDT05URU5ETyBVTSBURVhUTyBRVUFMUVVFUgogKiBAcGFyYW0gJF9jdXJXb3JkU3RyaW5nQXJyYXlbJ3dvcmRzJ10gICAgICAgICAgICAgICBRVUFOVElEQURFIERFIFBBTEFWUkFTIFFVRSBJUsODTyBGSUNBUgogKiBAcGFyYW0gJF9jdXJXb3JkU3RyaW5nQXJyYXlbJ2RlY29kZV9odG1sJ10gICAgIFRSVUUgT1IgRkFMU0UKICogQHBhcmFtICRfY3VyV29yZFN0cmluZ0FycmF5WydyZW1vdmVfdGFncyddICAgICBUUlVFIE9SIEZMQVNFCiAqIEByZXR1cm4gYm9vbGVhbgogKi8KJF9jdXJXb3JkU3RyaW5nQXJyYXlbJ3N0cmluZyddID0gU0VVLVRFWFRPLUFRVUkKJF9jdXJXb3JkU3RyaW5nQXJyYXlbJ3dvcmRzJ10gPSBRVUFOVElEQURFLURFLVBBTEFWUkFTCiRfY3VyV29yZFN0cmluZ0FycmF5WydkZWNvZGVfaHRtbCddID0gVFJVRTsKJF9jdXJXb3JkU3RyaW5nQXJyYXlbJ3JlbW92ZV90YWdzJ10gPSBUUlVFOwokX3IgPSBtY19jdXRfd29yZF9zdHJpbmcoICRfY3VyV29yZFN0cmluZ0FycmF5WydzdHJpbmcnXSwgJF9jdXJXb3JkU3RyaW5nQXJyYXlbJ3dvcmRzJ10sICRfY3VyV29yZFN0cmluZ0FycmF5WydkZWNvZGVfaHRtbCddLCAkX2N1cldvcmRTdHJpbmdBcnJheVsncmVtb3ZlX3RhZ3MnXSk7");
define('___MACRO_DIVERSOS_MONTH_DATE___', "LyoKICogTUFDUk8gUVVFIFJFVE9STkEgTyBNw4pTIERFIFVNQSBEQVRBCiAqIFNlIG5vbWU9dHJ1ZSwgcmV0b3JuYSBvIG3DqnMgcG9yIGV4dGVuc28uCiAqCiAqIEBwYXJhbSBkYXRlICRfbW9udGhEYXRhQXJyYXlbJ2RhdGUnXSAgICAgICAgICAgICAgICAgICAgIEluZm9ybWUgdW1hIGRhdGEKICogQHBhcmFtIGJvb2xlYW4gJF9tb250aERhdGFBcnJheVsnZXh0ZW5zaXZlJ10gICAgICAgICBUUlVFIHBhcmEgcmV0b3JuYXIgTcOqcyBwb3IgZXh0ZW5kbywgRkFMU0UgcGFyYSByZXRvcm5hciBvIG7Dum1lcm8gZG8gTcOqcwogKiBAcmV0dXJuIGJvb2xlYW58c3RyaW5nCiAqLwogCiRfbW9udGhEYXRhQXJyYXlbJ2RhdGUnXSA9IElORk9STUUtVU1BLURBVEEKJF9tb250aERhdGFBcnJheVsnZXh0ZW5zaXZlJ10gPSBUUlVFOwokX3IgPSAgbWNfbW9udGhfZGF0ZSggJF9tb250aERhdGFBcnJheVsnZGF0ZSddLCAkX21vbnRoRGF0YUFycmF5WydleHRlbnNpdmUnXSApOw==");
define('___MACRO_DIVERSOS_EXTENSIVE_VALUE___', "LyoKICogTUFDUk8gUVVFIFJFVE9STkEgVkFMT1IgUE9SIEVYVEVOU08uCiAqCiAqICRfZXh0ZW5zaXZlVmFsdWVBcnJheVsndmFsdWUnXSAgICAgICAgICAgICAgICAgICAgIFVtIHZhbG9yCiAqICRfZXh0ZW5zaXZlVmFsdWVBcnJheVsnc2hvd19jZW50cyddICAgICAgICAgICAgVFJVRSBtb3N0cmEgdmFsb3IgZG9zIGNlbnRhdm9zIHBvciBleHRlbnNvCiAqICRfZXh0ZW5zaXZlVmFsdWVBcnJheVsnZmVtaW5pbmVfd29yZCddICAgICAgIFRSVUUgbW9zdHJhIHBhbGF2cmEgbm8gZmVtaW5pbm8KICoKICogQWxndW5zIGV4ZW1wbG9zIGRlIHVzbyBkYSBtYWNybzoKICoKICogLy9WYWkgZXhpYmlyIG5hIHRlbGEgJ3VtIG1pbGjDo28sIHF1YXRyb2NlbnRvcyBlIG9pdGVudGEgZSBzZXRlIG1pbCwgZHV6ZW50b3MgZSBjaW5xdWVudGEgZSBzZXRlIGUgY2lucXVlbnRhIGUgY2luY28nCiAqIGVjaG8gbWNfZXh0ZW5zaXZlX3ZhbHVlKCcxLjQ4Ny4yNTcsNTUnLCBmYWxzZSwgZmFsc2UpOwogKgogKiAvL1ZhaSBleGliaXIgbmEgdGVsYSAndW0gbWlsaMOjbywgcXVhdHJvY2VudG9zIGUgb2l0ZW50YSBlIHNldGUgbWlsLCBkdXplbnRvcyBlIGNpbnF1ZW50YSBlIHNldGUgcmVhaXMgZSBjaW5xdWVudGEgZSBjaW5jbyBjZW50YXZvcycKICogZWNobyB2YWxvclBvckV4dGVuc28oJzEuNDg3LjI1Nyw1NScsIHRydWUsIGZhbHNlKTsKICoKICogLy9WYWkgZXhpYmlyIG5hIHRlbGEgJ2R1YXMgbWlsIGUgc2V0ZWNlbnRhcyBlIG9pdGVudGEgZSBzZXRlJwogKiBlY2hvIG1jX2V4dGVuc2l2ZV92YWx1ZSgnMjc4NycsIGZhbHNlLCB0cnVlKTsKICovCiRfZXh0ZW5zaXZlVmFsdWVBcnJheVsndmFsdWUnXSA9IFNFVS1WQUxPUi1BUVVJCiRfZXh0ZW5zaXZlVmFsdWVBcnJheVsnc2hvd19jZW50cyddID0gVFJVRTsKJF9leHRlbnNpdmVWYWx1ZUFycmF5WydmZW1pbmluZV93b3JkJ10gPSBGQUxTRTsKJF9yID0gbWNfZXh0ZW5zaXZlX3ZhbHVlKCRfZXh0ZW5zaXZlVmFsdWVBcnJheVsndmFsdWUnXSAsICRfZXh0ZW5zaXZlVmFsdWVBcnJheVsnc2hvd19jZW50cyddLCAkX2V4dGVuc2l2ZVZhbHVlQXJyYXlbJ2ZlbWluaW5lX3dvcmQnXSApOw==");
define('___MACRO_DIVERSOS_FARMAT_DATE___', "LyoqCiAqIENPTlZFUlRFIERBVEEgUEFSQSBPIFBBRFJBzINPIFFVRSBGT1IgUEFTU0FETyBOTyBQQVJBTUVUUk8gJF9mb3JtYXREYXRhQXJyYXlbJ21hc2MnXQogKgogKiBFeGVtcGxvIDogbWNfZm9ybWF0X2RhdGUoREFUQSwnZC9tL1kgSDppOnMnKTsKICoKICogQHBhcmFtIGRhdGUgJF9mb3JtYXREYXRlQXJyYXlbJ2RhdGUnXSAgICAgUGFzc2EgYSBzdHJpbmcgY29tIGEgZGF0YQogKiBAcGFyYW0gc3RyaW5nICRfZm9ybWF0RGF0ZUFycmF5WydtYXNjJ10gICBDb21vIGEgZGF0YSBzZXLDoSBmb3JtYXRhZGEuIEV4ZW1wbG86ICdkL20vWSBIOmk6cycKICovCiRfZm9ybWF0RGF0ZUFycmF5WydkYXRlJ10gPSBJTkZPUk1FLVVNQS1EQVRBCiRfZm9ybWF0RGF0ZUFycmF5WydtYXNjJ10gPSAnZC9tL1knOwokX3IgPSBtY19mb3JtYXRfZGF0ZSggJF9mb3JtYXREYXRlQXJyYXlbJ2RhdGUnXSwgJF9mb3JtYXREYXRlQXJyYXlbJ21hc2MnXSApOw==");
define('___MACRO_DIVERSOS_CONTAINS_STRING___', "LyoqCiAqIFBFU1FVSVNBIFVNIE9DT1JSw4pOQ0lBIERFTlRSTyBERSBVTUEgU1RSSU5HCiAqIAogKiBVc2FuZG8gYSBhbmFsb2dpYSBkZSBlbmNvbnRyYXIgdW1hIGFndWxoYSBlbSB1bSBwYWxoZWlyby4KICogCiAqIEBwYXJhbSBzdHJpbmcgJF9jb250YWluc1N0cmluZ0FycmF5WydhZ3VsaGEnXSAgICAgICAgIEFndWxoYSAtIE8gcXXDqiB2YyBkZXNlamEgZW5jb250cmFyCiAqIEBwYXJhbSBzdHJpbmcgJF9jb250YWluc1N0cmluZ0FycmF5WydwYWxoZWlybyddICAgICAgIFBhbGhlaXJvIC0gT25kZSB2b2PDqiBkZXNlamEgZW5jb250cmFyCiAqIEByZXR1cm4gc3RyaW5nCiAqLwokX2NvbnRhaW5zU3RyaW5nQXJyYXlbJ2FndWxoYSddID0gJyc7CiRfY29udGFpbnNTdHJpbmdBcnJheVsncGFsaGVpcm8nXSA9ICcnOwokX3IgPSBtY19jb250YWluc19pbl9zdHJpbmcoJF9jb250YWluc1N0cmluZ0FycmF5WydhZ3VsaGEnXSwgJF9jb250YWluc1N0cmluZ0FycmF5WydwYWxoZWlybyddKTs=");
define('___MACRO_DIVERSOS_FORMAT_MOEDA___', "LyoqCiAqIE1BQ1JPIFBBUkEgRk9STUFUQcOHw4NPIERFIFZBTE9SRVMKICogCiAqICRfZm9ybWF0TW9lZGFBcnJheVsndmFsb3InXSAgICAgICAgICAgICAgVmFsb3IgcGFyYSBmb3JtYXRhw6fDo28KICogJF9mb3JtYXRNb2VkYUFycmF5WydkZWNpbWFsJ10gICAgICAgICAgUXVhbnRpZGFkZSBkZSBjYXNhcyBkZWNpbWFpcwogKiAkX2Zvcm1hdE1vZWRhQXJyYXlbJ2xhbmcnXSAgICAgICAgICAgICAgIGJyID0gVmFsb3IgcGFkcsOjbyBCcmFzaWwgLSBlbiA9IFZhbG9yIHBhZHLDo28gQW1lcmljYW5vCiAqICRfZm9ybWF0TW9lZGFBcnJheVsnY2lmcmFvJ10gICAgICAgICAgICAgTnVsbCBwYXJhIG5lbmh1bSBvdSBpbmZvcm1hciBvIGNpZnLDo28gcmVmZXJlbnRlIGEgZm9ybWF0YcOnw6NvLiBFeDogUiQgcGFyYSBSZWFsIG91IFUkIHBhcmEgRG9sYXIKICoKICovCiAKJF9mb3JtYXRNb2VkYUFycmF5Wyd2YWxvciddID0gJzEwMDAuMDAnOwokX2Zvcm1hdE1vZWRhQXJyYXlbJ2RlY2ltYWwnXSA9ICcyJzsKJF9mb3JtYXRNb2VkYUFycmF5WydsYW5nJ10gPSAnYnInOwokX2Zvcm1hdE1vZWRhQXJyYXlbJ2NpZnJhbyddID0gJ1IkICc7IAogCiRfciA9IG1jX2Zvcm1hdF9tb2VkYSggJF9mb3JtYXRNb2VkYUFycmF5Wyd2YWxvciddLCAgJF9mb3JtYXRNb2VkYUFycmF5WydkZWNpbWFsJ10sICRfZm9ybWF0TW9lZGFBcnJheVsnbGFuZyddLCAkX2Zvcm1hdE1vZWRhQXJyYXlbJ2NpZnJhbyddICk7");
define('___MACRO_DIVERSOS_RANDOM_STRING___', "LyoqCiAqIE1BQ1JPIFFVRSBHRVJBIFVNQSBTVFJJTkcgUkFORE9NSUNBLgogKgogKiAkX3JhbmRvbU51bWJlckFycmF5WydjaGFyc19taW4nXSAgICAgICAgICAgICAgICAgICAgIE3DrW5pbW8gZGUgY2FyYWN0ZXJlcyBhIHNlciBnZXJhZG8KICogJF9yYW5kb21OdW1iZXJBcnJheVsnY2hhcnNfbWF4J10gICAgICAgICAgICAgICAgICAgIE3DoXhpbW8gZGUgY2FyYWN0ZXJlcyBhIHNlciBnZXJhZG8KICogJF9yYW5kb21OdW1iZXJBcnJheVsndXBwZXJfY2FzZSddICAgICAgICAgICAgICAgICAgIFJldG9ybmEgY2FyYWN0ZXJlcyBtYWl1c2xvcyBvdSBtaW51c2N1bG9zCiAqICRfcmFuZG9tTnVtYmVyQXJyYXlbJ2luY2x1ZGVfbGV0dGVyJ10gICAgICAgICAgICAgICAgU2UgdmFpIHRlciBsZXRyYXMgbmEgc3RyaW5nCiAqICRfcmFuZG9tTnVtYmVyQXJyYXlbJ2luY2x1ZGVfbnVtYmVycyddICAgICAgICAgICBTZSB2YWkgdGVyIG7Dum1lcm9zIG5hIHN0cmluZwogKiAkX3JhbmRvbU51bWJlckFycmF5WydpbmNsdWRlX3NwZWNpYWxfY2hhcnMnXSAgICBTZSB2YWkgdGVyIGNhcmFjdGVyZXMgZXNwZWNpYWlzIG5hIHN0cmluZwogKgogKi8KCiRfcmFuZG9tTnVtYmVyQXJyYXlbJ2NoYXJzX21pbiddID0gJzYnOwokX3JhbmRvbU51bWJlckFycmF5WydjaGFyc19tYXgnXSA9ICc2JzsKJF9yYW5kb21OdW1iZXJBcnJheVsndXBwZXJfY2FzZSddID0gRkFMU0U7CiRfcmFuZG9tTnVtYmVyQXJyYXlbJ2luY2x1ZGVfbGV0dGVyJ10gPSBGQUxTRTsKJF9yYW5kb21OdW1iZXJBcnJheVsnaW5jbHVkZV9udW1iZXJzJ10gPSBUUlVFOwokX3JhbmRvbU51bWJlckFycmF5WydpbmNsdWRlX3NwZWNpYWxfY2hhcnMnXSA9IEZBTFNFOwogCiRfciA9IG1jX3JhbmRvbV9udW1iZXIoICRfcmFuZG9tTnVtYmVyQXJyYXlbJ2NoYXJzX21pbiddLCAkX3JhbmRvbU51bWJlckFycmF5WydjaGFyc19tYXgnXSwgJF9yYW5kb21OdW1iZXJBcnJheVsndXBwZXJfY2FzZSddLCAkX3JhbmRvbU51bWJlckFycmF5WydpbmNsdWRlX2xldHRlciddLCAkX3JhbmRvbU51bWJlckFycmF5WydpbmNsdWRlX251bWJlcnMnXSwgJF9yYW5kb21OdW1iZXJBcnJheVsnaW5jbHVkZV9zcGVjaWFsX2NoYXJzJ10gKTs=");
define('___MACRO_DIVERSOS_FILL_STRING___', "LyoqCiAqIE1BQ1JPIFFVRSBQUkVFTkNIRSBVTUEgU1RSSU5HIENPTSBDQVJBQ1RFUkVTCiAqIAogKiAkX2ZpbGxTdHJpbmdBcnJheVsnc3RyaW5nJ10gICAgICAgICAgICAgUGFzc2EgYSBzdHJpbmcgY29tIG9zIGRhZG9zCiAqICRfZmlsbFN0cmluZ0FycmF5WydvcmllbnRhY2FvJ10gICAgICBFc3F1ZXJkYSBMRUZULCBEaXJldGlhIFJJR0hULiBQb3IgcGFkcsOjbyBzZXLDoSBMRUZUCiAqICRfZmlsbFN0cmluZ0FycmF5WydjYXJhY3RlciddICAgICAgICAgUXVhbCBvIHRpcG8gZGUgY2FyYWN0YXIgcXVlIHNlcsOhIGFkaWNpb25hZG8gYSBTdHJpbmcuIFBvciBwYWRyw6NvIHNlcsOhICoKICogJF9maWxsU3RyaW5nQXJyYXlbJ3F1YW50aWRhZGUnXSAgICAgUXVhbnRpZGFkZSBkZSBjYXJhY3RhciBxdWUgc2Vyw6EgYWRpY2lvbmFkbyBhIFN0cmluZwogKi8KIAokX2ZpbGxTdHJpbmdBcnJheVsnc3RyaW5nJ10gPSAnMTAwJzsKJF9maWxsU3RyaW5nQXJyYXlbJ29yaWVudGFjYW8nXSA9ICdSSUdIVCc7CiRfZmlsbFN0cmluZ0FycmF5WydjYXJhY3RlciddID0gJyonOwokX2ZpbGxTdHJpbmdBcnJheVsncXVhbnRpZGFkZSddID0gJzEwJzsKIAokX3IgPSBtY19maWxsX3N0cmluZyggJF9maWxsU3RyaW5nQXJyYXlbJ3N0cmluZyddLCAkX2ZpbGxTdHJpbmdBcnJheVsnb3JpZW50YWNhbyddLCAkX2ZpbGxTdHJpbmdBcnJheVsnY2FyYWN0ZXInXSwgJF9maWxsU3RyaW5nQXJyYXlbJ3F1YW50aWRhZGUnXSApOw==");
define('___MACRO_DIVERSOS_REDIRECT_APP___', "LyoqCiAqIE1BQ1JPIFJFRElSRUNUCiAqIAogKiAkX3JlZGlyZWN0QXBwQXJyYXlbJ2FwcCddICAgICAgICBOb21lIGRvIEFQUCBwYXJhIG9uZGUgc2Vyw6EgcmVkaXJlY2lvbmFkbwogKiAkX3JlZGlyZWN0QXBwQXJyYXlbJ3BhcmFtJ10gICAgUGFyw6JtZXRyb3MgcGFyYSBkbyByZWRpcmVjaW9uYW1lbnRvLiBFeC4gc2VhcmNoPW5vbWUmZmllbGQ9dGV4dCBvdSBOVUxMIHBhcmEgbmVuaHVtCiAqLwokX3JlZGlyZWN0QXBwQXJyYXlbJ2FwcCddID0gJyc7CiRfcmVkaXJlY3RBcHBBcnJheVsncGFyYW0nXSA9ICdzZWFyY2g9JzsKbWNfcmVkaXJlY3QoICRfcmVkaXJlY3RBcHBBcnJheVsnYXBwJ10sICRfcmVkaXJlY3RBcHBBcnJheVsncGFyYW0nXSApIDs=");
define('___MACRO_DIVERSOS_PARAMETERS_URL___', "LyoqCiAqIE1BQ1JPIFFVRSBQRUdBIE9TIFBBUsOCTUVUUk9TIERBIFVSTAogKgogKi8KJF9yID0gbWNfZ2V0X3BhcmFtZXRlcnNfdXJsKCk7");




/* END CÓDIGO DAS MACROS */
?>

<aside class="control-sidebar control-sidebar-light" style="position: fixed; max-height: 100%; overflow: auto; padding-bottom: 50px;">
    <div id="" class="" style="margin-top:-50px; text-align: center;"><h4>Macros</h4></div>

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

        <li class="active"><a href="#control-sidebar-database-tab" data-toggle="tab"><i class="fa fa-database"></i></a></li>
        <li><a href="#control-sidebar-modelo-tab" data-toggle="tab"><i class="fa fa-language"></i></a></li>
        <li><a href="#control-sidebar-diversos-tab" data-toggle="tab"><i class="fa fa-puzzle-piece"></i></a></li>
        <li><a><span class="fa fa-close j-tooltip mouse-cursor-pointer" data-toggle="control-sidebar" data-placement="bottom" data-toggle="tooltip" data-original-title="Fechar"></span></a></li>

    </ul>




    <!-- Stats tab content -->
    <div class="tab-content">


        <!-- Data Base tab content -->
        <div class="tab-pane active" id="control-sidebar-database-tab" style="margin-top:-15px;">

            <h4 class='control-sidebar-heading'>
                <spam>Data Base</spam>
            </h4>

            <ul class="list-unstyled clearfix" style="margin-top:-10px">
                <li style="float:left; width: 100%; padding: 0px;">

                    <ul class="list-unstyled">
                        <li class="margin-bottom-3">Insert, Update, Delete</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DATABASE_INSERT___); ?>">Insert</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DATABASE_UPDATE___); ?>">Update</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DATABASE_DELETE___); ?>">Delete</button></li>

                        <li class="margin-bottom-3 margin-top-10">Find Data Query</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_ALL___); ?>">Find All Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_BY_ID___); ?>">Find By ID Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_BY_FIELD___); ?>">Find By Field Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_ARRAY_FIND_WHERE_PARAM___); ?>">Find By Where Data</button></li>

                        <li class="margin-bottom-3 margin-top-10">Auditoria</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_AUDITORIA_ADD___); ?>">Auditoria Add</button></li>

                        <li class="margin-bottom-3 margin-top-10">Depuração</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_VAR_DUMP___); ?>">var_dump()</button></li>

                    </ul>


                </li>
            </ul>
        </div>
        <!-- Data Base tab content -->

        <!-- Modelo 1 tab content -->
        <div class="tab-pane" id="control-sidebar-modelo-tab" style="margin-top:-15px;">

            <h4 class='control-sidebar-heading'>
                Modelos
            </h4>

            <ul class="list-unstyled clearfix" style="margin-top:-10px">
                <li style="float:left; width: 100%; padding: 0px;">

                    <ul class="list-unstyled">
                        <li class="margin-bottom-3">Modals e Alerts</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_MODAL___); ?>">Modal</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_BOOTSTRAP_DEFAULT___); ?>">Alert Default</button></li>                        
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_NOTFIT___); ?>">Alert NotFit</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_SWEET___); ?>">Alert Sweet</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ALERT_TOAST___); ?>">Alert Toast</button></li>

                        <li class="margin-bottom-3 margin-top-10">Email</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_SEND_MAIL___); ?>">Send Mail</button></li>

                        <li class="margin-bottom-3 margin-top-10">Array Filter</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_FILTER_FIELD___); ?>">Array Filter Field</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_FILTER_LIKE___); ?>">Array Filter Like</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_CASE_SENSITIVE___); ?>">Array Case Sensitive</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_MODELO_ARRAY_EXCLUDE_FIELD___); ?>">Array Exclude Fields</button></li>



                        <li class="margin-bottom-3 margin-top-10">Depuração</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_VAR_DUMP___); ?>">var_dump()</button></li>


                    </ul>


                </li>
            </ul>
        </div>
        <!-- Modelo 1 tab content -->

        <!-- Modelo 2 tab content -->
        <div class="tab-pane" id="control-sidebar-diversos-tab" style="margin-top:-15px;">

            <h4 class='control-sidebar-heading'>
                Diversos
            </h4>

            <ul class="list-unstyled clearfix" style="margin-top:-10px">
                <li style="float:left; width: 100%; padding: 0px;">

                    <ul class="list-unstyled">

                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_CUT_WORDS___); ?>">String Corta Palavras</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_MONTH_DATE___); ?>">Mês de uma Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_EXTENSIVE_VALUE___); ?>">Valor por Extenso</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_FARMAT_DATE___); ?>">Formata Data</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_CONTAINS_STRING___); ?>">Contem na String</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_FORMAT_MOEDA___); ?>">Formatação de Moeda</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_RANDOM_STRING___); ?>">String Randômica</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_FILL_STRING___); ?>">Preenche String</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_REDIRECT_APP___); ?>">Redirect</button></li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_PARAMETERS_URL___); ?>">Parâmetros da URL</button></li>




                        <li class="margin-bottom-3 margin-top-10">Depuração</li>
                        <li><button type="button" class="btn btn-default btn-block margin-bottom-3 j-btn-sidebar-database-insert" data-toggle="control-sidebar" data-clipboard-message="Código copiado com sucesso, CTRL+V para colar no editor." data-clipboard-text="<?= base64_decode(___MACRO_DIVERSOS_VAR_DUMP___); ?>">var_dump()</button></li>

                    </ul>


                </li>
            </ul>
        </div>
        <!-- Modelo 2 tab content -->




    </div><!-- /.tab-pane -->
    <!-- Stats tab content -->


</aside>



<!--END SIDEBAR CASE MACROS-->


<script>

    $(function () {


//        $('#test').click(function () {
//            var currentVal = $('#codeeditor_1').val();
//            $('#codeeditor_1').val('Code Aqui...');
//        });




    });

</script>