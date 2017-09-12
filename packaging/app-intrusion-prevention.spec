
Name: app-intrusion-prevention
Epoch: 1
Version: 2.4.2
Release: 1%{dist}
Summary: Intrusion Prevention System
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base
Requires: app-intrusion-detection >= 2.1.7
Requires: app-network

%description
The Intrusion Prevention System actively monitors network traffic and blocks unwanted traffic before it can harm your network.

%package core
Summary: Intrusion Prevention System - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: app-date-core
Requires: app-network-core >= 1:1.4.70
Requires: app-intrusion-detection-core >= 1:2.1.7
Requires: snort >= 2.9.6.2-8
Requires: app-firewall-core >= 1:2.4.0

%description core
The Intrusion Prevention System actively monitors network traffic and blocks unwanted traffic before it can harm your network.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/intrusion_prevention
cp -r * %{buildroot}/usr/clearos/apps/intrusion_prevention/

install -d -m 0755 %{buildroot}/var/clearos/intrusion_prevention
install -d -m 0755 %{buildroot}/var/clearos/intrusion_prevention/backup
install -D -m 0644 packaging/intrusion_prevention.conf %{buildroot}/etc/clearos/intrusion_prevention.conf
install -D -m 0644 packaging/snortsam.php %{buildroot}/var/clearos/base/daemon/snortsam.php
install -D -m 0644 packaging/webconfig-whitelist.conf %{buildroot}/etc/snortsam.d/webconfig-whitelist.conf

%post
logger -p local6.notice -t installer 'app-intrusion-prevention - installing'

%post core
logger -p local6.notice -t installer 'app-intrusion-prevention-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/intrusion_prevention/deploy/install ] && /usr/clearos/apps/intrusion_prevention/deploy/install
fi

[ -x /usr/clearos/apps/intrusion_prevention/deploy/upgrade ] && /usr/clearos/apps/intrusion_prevention/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-intrusion-prevention - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-intrusion-prevention-core - uninstalling'
    [ -x /usr/clearos/apps/intrusion_prevention/deploy/uninstall ] && /usr/clearos/apps/intrusion_prevention/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/intrusion_prevention/controllers
/usr/clearos/apps/intrusion_prevention/htdocs
/usr/clearos/apps/intrusion_prevention/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/intrusion_prevention/packaging
%exclude /usr/clearos/apps/intrusion_prevention/unify.json
%dir /usr/clearos/apps/intrusion_prevention
%dir /var/clearos/intrusion_prevention
%dir /var/clearos/intrusion_prevention/backup
/usr/clearos/apps/intrusion_prevention/deploy
/usr/clearos/apps/intrusion_prevention/language
/usr/clearos/apps/intrusion_prevention/libraries
%config(noreplace) /etc/clearos/intrusion_prevention.conf
/var/clearos/base/daemon/snortsam.php
%config(noreplace) /etc/snortsam.d/webconfig-whitelist.conf
