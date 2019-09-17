<?php

defined("BASEPATH") OR exit("No direct script access allowed");

/**
 * CodeIgniter Ldap_Auth
 * 
 * Configuration file used to drive the Ldap_Auth library
 *
 * @package         Ldap_Auth
 * @subpackage      Auth configuration
 * @author          Lucas Halbert <lhalbert@lhalbert.xyz>
 * @version         0.0.2
 * @link            https://github.com/lucashalbert/codeigniter-Ldap_Auth
 * @license         BSD 3-Clause "New" or "Revised" License
 * @copyright       Copyright © 2019 by Lucas Halbert <lhalbert@lhalbert.xyz>
 */


/**
 * CustomerA Configuration
 */
$config["customerA"]["servers"] = array("ldap://dc1.customerA.tld",
										"ldap://dc2.customerA.tld",
										"ldap://dc3.customerA.tld");
$config["customerA"]["tls_ca_cert"] = "-----BEGIN CERTIFICATE-----
MIICpjCCAY4CCQDQn/6kcadhszANBgkqhkiG9w0BAQsFADAVMRMwEQYDVQQDDApF
WEFNUExFLUNBMB4XDTE5MDkxNzE3NTgwMFoXDTIyMDYxMzE3NTgwMFowFTETMBEG
A1UEAwwKRVhBTVBMRS1DQTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEB
AKOgLfsY8wD9xWYOiJguvzQ5vkInPbqEPhdeeAhNW0tjKWsePkVcsq4e+sH3haqL
cF46O79GkVKpdE803pwg55RaGBLtXCgqX51xZihjYnlcJFei6lNNu8yYzMnONn5y
4Q1zj54SnJAwU4S/7HBxtCWcnalUJltBShUFtsAnSGevNdoTPrzDLHdV2/TrOGDS
8e/f29i9GWLGd3XLC5HMDiPkQGDFLsUfSXY1pzpPNWJwxlqBxU3Ktq/xv7eRopod
ij6SkosV5UQKN+d8ohzPOujhxApzdniA0Zwm0mT6lnr+mQodrQCkbkdohGo1gJAb
iMD+8Mup510Yppcyy5oKkfECAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAiBRclgHM
PhHpAJPVfEuI0gSpQ6y65bitEJ6tRvbA8d8ndkBG3tR9VH3ZhUtn2cTySWs+Gfnp
oIrOHoLmgZbadsyPGcR+ay9GtwTYo6TEm3IVItmeAWTbxy8LfyDSrT6P7f5+JPna
00ONnehAKPYeoKnOQHivn64Pb8SIyre11RswCfVqFhSoQALP/e3Z1ryNQXxwAuuS
1znpWvYVNS/OWIBXylq5RfrHqekUwvO1ceMEY1vTPTLFWphRZfUoOsxqjTwzFcoV
Q/IgG8FiYuzk799o1iMeHoysHxgcS5OoTg7mc0pkwxnsyEv8XrtsRVQcKwGaEsW/
k5CcB12nyj59Fg==
-----END CERTIFICATE-----";
$config["customerA"]["tls_cert"] = "-----BEGIN CERTIFICATE-----
MIICqzCCAZMCCQCw2DH1AS1LejANBgkqhkiG9w0BAQsFADAVMRMwEQYDVQQDDApF
WEFNUExFLUNBMB4XDTE5MDkxNzE3NTkzNVoXDTIyMDYxMzE3NTkzNVowGjEYMBYG
A1UEAwwPc2VydmljZS1hY2NvdW50MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB
CgKCAQEAvO6yb2ewfuHI81lTZa9OKfrw8D2GVE//y3ogKqpiaTxdotSXsEmZPw77
n6TWiJy4OuBWe6y5LIkpKxNmLl7pjlwqcRH9pcuW671ub7kMpP1D4gMjoI9a8SAb
KGxaXB7KSeNslQs9eBNvHWsZGruLuSCVyOKpFiZVHQS/0C7XRZdA+gLTla4SZiBy
Xq5153OuXbRd/qMWPDe/rdEnGRG/w2ad/VdJ9ZehO0Gheu9+mLiKCHxyYJXqV8pl
6zr+5/WUWJb/XHdmtSed9vLdhYWyvAV6SY4smLO050ptpEZ/TRtoyP+lu+GOkvcY
X56b6UBM7wGi4eaxgEP+a3A9OyC1JwIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQAP
SDEEYiLJVK73pi7MTDWo2uFef1W+eUpN7e4H4m0miXjJz1DzC7Ql4xdPIcCEagkd
i3sNQ2tRtZZUqkAOZb/0qHYLqpujBai8foc7ys6F1D10EKiaXPZm+bl3cWdrslgK
bI4dLCs48OtSCxltV2kxiGMsAZFVdxPc31dIIQFVNzyhwlUXwOsGLtPSH2D9v+68
LHh3Ay4nU+TCEbSd8zJwbhoKG9RY5dP12XIDwm15cPA7xG2bwiyJHaRSvrTWDMsn
CzvOkm2NKpqiXRxATM++nY804E76cRnK8Z0UOBBpDR/Jc6qDaIem9RrL3VLAjBSN
tMzvgYv52AV+nQ77lDIM
-----END CERTIFICATE-----";
$config["customerA"]["tls_key"] = "-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAvO6yb2ewfuHI81lTZa9OKfrw8D2GVE//y3ogKqpiaTxdotSX
sEmZPw77n6TWiJy4OuBWe6y5LIkpKxNmLl7pjlwqcRH9pcuW671ub7kMpP1D4gMj
oI9a8SAbKGxaXB7KSeNslQs9eBNvHWsZGruLuSCVyOKpFiZVHQS/0C7XRZdA+gLT
la4SZiByXq5153OuXbRd/qMWPDe/rdEnGRG/w2ad/VdJ9ZehO0Gheu9+mLiKCHxy
YJXqV8pl6zr+5/WUWJb/XHdmtSed9vLdhYWyvAV6SY4smLO050ptpEZ/TRtoyP+l
u+GOkvcYX56b6UBM7wGi4eaxgEP+a3A9OyC1JwIDAQABAoIBAAIMuOTahCCsRGjX
dD8rKrbr4QdKM5XglE7Z0VWFKbIolH96vPaNpdr4R6SQvj8XLCx/WJDY691e05KD
EF26a+A+gbteTZkp30ZJdNRDdq6njL/79rv8Milhhsnmewh60QkCLaBkUdNmqpLw
IYKXvElS4C0gwGLcIZpB/e69Q1qe57DoufMn4SImh8dIjVjFrZ6hzF4/SgfRVwrS
hnvsMzPosCJ0DkaZqYbSVRULgubQVVr/lDvwDULWv6NTG1ritPkl5Ns/NLDQBuc1
EDO0w6+G6xOovk6JvIvP3cJ2AyGZiziiQdVvh83dHSLBNJZc+j2VHEh79S7eIBru
QNAxdDECgYEA3adr3cWb8/wBKPdwB9sfxoNEeng5lfYecw/q8HmzsnMyVBuKBSCh
dd8SDQkKC5Qktc90/9RdWiycNkQVk+8aTGPElIZy9tETc6xs+JVfxzTPbNnx5Ago
PDur1az89H0i0Q43aU4UsOtOncb6L0aUjd4EK/NgUuv6yq3607nfN/8CgYEA2jVG
W8BKLvdipJCIA7b8RVsvzHcNljLh5qmTpnBQUx/+/A8ZssXcj0gSz1u4GfeH4t2Z
L8BTfuzjH2yMgmDj+Sf/bDm7AhEv/et68fuumbDCnfh/IZPFDNDquEDSJn8TTSJO
XmKB40Ycxvm8EJ3JaeQ3e2X6ETrhhAMuNpOFwtkCgYEAkMuZz1oTsqLhLx3U9YzT
iR6fUVHQbIJHCetQEp+uH9jY+9CxrP/P+ewrIpDRGxc/k/Vd/PGBujKCKYD4h5ce
muBhvpTF7S5PgrUUyp7p3nxFNFp7hfc+MXrZmdBTvnMwl1iuIgB7y8crqC4fqVp2
GOb72qo2NnUpc9WLkVxO0YkCgYEAnmf+Y6z8LYw5d+3UT54PFOpVkMD8hAT8KU8B
eNof9bhMiv8LUNSCgSF5Rj73LyKa6v6jrh6YfpPJbY6Hkj50QPPgYNioAaAojtTb
s79ZyQigv70dzWpQqjUfsBKefIPTpzM4YRxx3mOPkILLG+Tvyod6H4KwPsHX5NXK
PqRpfkECgYAB8GyA4sgrREL6S8SjLLHjU0KA0ViDm6q6PS3fhl70z07tEArFCsg2
jF83FdbpFVHVCOc6iGc0e7jjvQAyHtskSRL6IIbRPinP5Yq2RIz0z1QrP4l5iaev
TCjF9rxX9cs9ZKTBlbLnSG4Ok/p85n3eMKcI8A8Hq6WuHv/aFVl+Gw==
-----END RSA PRIVATE KEY-----";
$config["customerA"]["tls_required"] = TRUE;
$config["customerA"]["start_tls"] = TRUE;
$config["customerA"]["base_dn"] = "dc=domain,dc=customerA,dc=tld";
$config["customerA"]["user_attribute"] = "samaccountname";
$config["customerA"]["bind_user_dn"] = "DOMAIN\service-account";
$config["customerA"]["bind_user_pw"] = "password";
$config["customerA"]["member_attribute"] = "memberUid";


/**
 * CustomerB Configuration
 */
$config["customerB"]["servers"] = array("ldap://directory1.customerB.tld",
										"ldap://directory2.customerB.tld",
										"ldap://directory3.customerB.tld");
$config["customerB"]["tls_ca_cert"] = "-----BEGIN CERTIFICATE-----
MIICpjCCAY4CCQDQn/6kcadhszANBgkqhkiG9w0BAQsFADAVMRMwEQYDVQQDDApF
WEFNUExFLUNBMB4XDTE5MDkxNzE3NTgwMFoXDTIyMDYxMzE3NTgwMFowFTETMBEG
A1UEAwwKRVhBTVBMRS1DQTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEB
AKOgLfsY8wD9xWYOiJguvzQ5vkInPbqEPhdeeAhNW0tjKWsePkVcsq4e+sH3haqL
cF46O79GkVKpdE803pwg55RaGBLtXCgqX51xZihjYnlcJFei6lNNu8yYzMnONn5y
4Q1zj54SnJAwU4S/7HBxtCWcnalUJltBShUFtsAnSGevNdoTPrzDLHdV2/TrOGDS
8e/f29i9GWLGd3XLC5HMDiPkQGDFLsUfSXY1pzpPNWJwxlqBxU3Ktq/xv7eRopod
ij6SkosV5UQKN+d8ohzPOujhxApzdniA0Zwm0mT6lnr+mQodrQCkbkdohGo1gJAb
iMD+8Mup510Yppcyy5oKkfECAwEAATANBgkqhkiG9w0BAQsFAAOCAQEAiBRclgHM
PhHpAJPVfEuI0gSpQ6y65bitEJ6tRvbA8d8ndkBG3tR9VH3ZhUtn2cTySWs+Gfnp
oIrOHoLmgZbadsyPGcR+ay9GtwTYo6TEm3IVItmeAWTbxy8LfyDSrT6P7f5+JPna
00ONnehAKPYeoKnOQHivn64Pb8SIyre11RswCfVqFhSoQALP/e3Z1ryNQXxwAuuS
1znpWvYVNS/OWIBXylq5RfrHqekUwvO1ceMEY1vTPTLFWphRZfUoOsxqjTwzFcoV
Q/IgG8FiYuzk799o1iMeHoysHxgcS5OoTg7mc0pkwxnsyEv8XrtsRVQcKwGaEsW/
k5CcB12nyj59Fg==
-----END CERTIFICATE-----";
$config["customerB"]["tls_cert"] = "-----BEGIN CERTIFICATE-----
MIICqzCCAZMCCQCw2DH1AS1LejANBgkqhkiG9w0BAQsFADAVMRMwEQYDVQQDDApF
WEFNUExFLUNBMB4XDTE5MDkxNzE3NTkzNVoXDTIyMDYxMzE3NTkzNVowGjEYMBYG
A1UEAwwPc2VydmljZS1hY2NvdW50MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB
CgKCAQEAvO6yb2ewfuHI81lTZa9OKfrw8D2GVE//y3ogKqpiaTxdotSXsEmZPw77
n6TWiJy4OuBWe6y5LIkpKxNmLl7pjlwqcRH9pcuW671ub7kMpP1D4gMjoI9a8SAb
KGxaXB7KSeNslQs9eBNvHWsZGruLuSCVyOKpFiZVHQS/0C7XRZdA+gLTla4SZiBy
Xq5153OuXbRd/qMWPDe/rdEnGRG/w2ad/VdJ9ZehO0Gheu9+mLiKCHxyYJXqV8pl
6zr+5/WUWJb/XHdmtSed9vLdhYWyvAV6SY4smLO050ptpEZ/TRtoyP+lu+GOkvcY
X56b6UBM7wGi4eaxgEP+a3A9OyC1JwIDAQABMA0GCSqGSIb3DQEBCwUAA4IBAQAP
SDEEYiLJVK73pi7MTDWo2uFef1W+eUpN7e4H4m0miXjJz1DzC7Ql4xdPIcCEagkd
i3sNQ2tRtZZUqkAOZb/0qHYLqpujBai8foc7ys6F1D10EKiaXPZm+bl3cWdrslgK
bI4dLCs48OtSCxltV2kxiGMsAZFVdxPc31dIIQFVNzyhwlUXwOsGLtPSH2D9v+68
LHh3Ay4nU+TCEbSd8zJwbhoKG9RY5dP12XIDwm15cPA7xG2bwiyJHaRSvrTWDMsn
CzvOkm2NKpqiXRxATM++nY804E76cRnK8Z0UOBBpDR/Jc6qDaIem9RrL3VLAjBSN
tMzvgYv52AV+nQ77lDIM
-----END CERTIFICATE-----";
$config["customerB"]["tls_key"] = "-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAvO6yb2ewfuHI81lTZa9OKfrw8D2GVE//y3ogKqpiaTxdotSX
sEmZPw77n6TWiJy4OuBWe6y5LIkpKxNmLl7pjlwqcRH9pcuW671ub7kMpP1D4gMj
oI9a8SAbKGxaXB7KSeNslQs9eBNvHWsZGruLuSCVyOKpFiZVHQS/0C7XRZdA+gLT
la4SZiByXq5153OuXbRd/qMWPDe/rdEnGRG/w2ad/VdJ9ZehO0Gheu9+mLiKCHxy
YJXqV8pl6zr+5/WUWJb/XHdmtSed9vLdhYWyvAV6SY4smLO050ptpEZ/TRtoyP+l
u+GOkvcYX56b6UBM7wGi4eaxgEP+a3A9OyC1JwIDAQABAoIBAAIMuOTahCCsRGjX
dD8rKrbr4QdKM5XglE7Z0VWFKbIolH96vPaNpdr4R6SQvj8XLCx/WJDY691e05KD
EF26a+A+gbteTZkp30ZJdNRDdq6njL/79rv8Milhhsnmewh60QkCLaBkUdNmqpLw
IYKXvElS4C0gwGLcIZpB/e69Q1qe57DoufMn4SImh8dIjVjFrZ6hzF4/SgfRVwrS
hnvsMzPosCJ0DkaZqYbSVRULgubQVVr/lDvwDULWv6NTG1ritPkl5Ns/NLDQBuc1
EDO0w6+G6xOovk6JvIvP3cJ2AyGZiziiQdVvh83dHSLBNJZc+j2VHEh79S7eIBru
QNAxdDECgYEA3adr3cWb8/wBKPdwB9sfxoNEeng5lfYecw/q8HmzsnMyVBuKBSCh
dd8SDQkKC5Qktc90/9RdWiycNkQVk+8aTGPElIZy9tETc6xs+JVfxzTPbNnx5Ago
PDur1az89H0i0Q43aU4UsOtOncb6L0aUjd4EK/NgUuv6yq3607nfN/8CgYEA2jVG
W8BKLvdipJCIA7b8RVsvzHcNljLh5qmTpnBQUx/+/A8ZssXcj0gSz1u4GfeH4t2Z
L8BTfuzjH2yMgmDj+Sf/bDm7AhEv/et68fuumbDCnfh/IZPFDNDquEDSJn8TTSJO
XmKB40Ycxvm8EJ3JaeQ3e2X6ETrhhAMuNpOFwtkCgYEAkMuZz1oTsqLhLx3U9YzT
iR6fUVHQbIJHCetQEp+uH9jY+9CxrP/P+ewrIpDRGxc/k/Vd/PGBujKCKYD4h5ce
muBhvpTF7S5PgrUUyp7p3nxFNFp7hfc+MXrZmdBTvnMwl1iuIgB7y8crqC4fqVp2
GOb72qo2NnUpc9WLkVxO0YkCgYEAnmf+Y6z8LYw5d+3UT54PFOpVkMD8hAT8KU8B
eNof9bhMiv8LUNSCgSF5Rj73LyKa6v6jrh6YfpPJbY6Hkj50QPPgYNioAaAojtTb
s79ZyQigv70dzWpQqjUfsBKefIPTpzM4YRxx3mOPkILLG+Tvyod6H4KwPsHX5NXK
PqRpfkECgYAB8GyA4sgrREL6S8SjLLHjU0KA0ViDm6q6PS3fhl70z07tEArFCsg2
jF83FdbpFVHVCOc6iGc0e7jjvQAyHtskSRL6IIbRPinP5Yq2RIz0z1QrP4l5iaev
TCjF9rxX9cs9ZKTBlbLnSG4Ok/p85n3eMKcI8A8Hq6WuHv/aFVl+Gw==
-----END RSA PRIVATE KEY-----";
$config["customerB"]["tls_required"] = TRUE;
$config["customerB"]["start_tls"] = TRUE;
$config["customerB"]["base_dn"] = "dc=customerB,dc=tld";
$config["customerB"]["user_attribute"] = "uid";
$config["customerB"]["bind_user_dn"] = "service-account";
$config["customerB"]["bind_user_pw"] = "password";
$config["customerB"]["member_attribute"] = "memberOf";
