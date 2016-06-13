# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  # Base Box
  # --------------------
  config.vm.box = "centos/7"

  # Connect to IP
  # Note: Use an IP that doesn't conflict with any OS's DHCP (Below is a safe bet)
  # --------------------
  config.vm.network :private_network, ip: "192.168.50.4"

  # Forward to Port
  # --------------------
  # config.vm.network :forwarded_port, guest: 80, host: 8080

  # Optional (Remove if desired)
  config.vm.provider :virtualbox do |v|
    # How much RAM to give the VM (in MB)
    # -----------------------------------
    v.customize ["modifyvm", :id, "--memory", "2048"]

    # Comment the bottom two lines to disable muli-core in the VM
    v.customize ["modifyvm", :id, "--cpus", "2"]
    v.customize ["modifyvm", :id, "--ioapic", "on"]
  end

  # Synced Folder
  # --------------------
  config.vm.synced_folder "./", "/www/api2cms"

  # Provisioning Script
  # --------------------
  config.vm.provision "shell", path: "provision.sh"

end
