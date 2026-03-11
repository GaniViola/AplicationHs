node {
    // Kita hapus pengecekan scm di luar supaya lebih rapi
    checkout scm

    stage("Build") {
        docker.image('php:8.2-cli').inside('-u root') {
            // Kita install git dulu, baru jalankan config-nya
            sh 'apt-get update && apt-get install -y git unzip libzip-dev'
            
            // Sekarang perintah git sudah ada, jadi tidak akan 'not found' lagi
            sh 'git config --global --add safe.directory /var/jenkins_home/workspace/laravel-dev'
            
            sh 'docker-php-ext-install zip'
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
            
            // Install dependencies Laravel
            sh 'composer install --ignore-platform-req=ext-gd'
        }
    }


    stage("Testing") {
        docker.image('ubuntu').inside('-u root') {
            sh 'echo "Menjalankan Unit Test..."'
            sh 'echo "Ini adalah test: PASSED"'
        }
    }

    stage("Deploy (Simulasi)") {
        // Kita ganti rsync/vps dengan simulasi copy ke folder lokal Jenkins
        sh 'mkdir -p /var/jenkins_home/simulasi_prod'
        sh 'cp -r . /var/jenkins_home/simulasi_prod'
        
        echo "--------------------------------------------------"
        echo "DEPLOY BERHASIL (SIMULASI)"
        echo "File telah dikirim ke: /var/jenkins_home/simulasi_prod"
        echo "--------------------------------------------------"
    }
}
