pipeline {
    agent any
    environment {
        staging_servers = "34.142.225.163"
    }

    stages {
        stage('Deploy to Remote') {
            steps {
                // Add the remote server's SSH key to known_hosts
                sh "ssh-keyscan -H ${staging_servers} >> ~/.ssh/known_hosts"
                
                // Use SSH agent with the credentials ID 'ssh-key'
                withCredentials([sshUserPrivateKey(credentialsId: 'ssh-new', keyFileVariable: 'SSH_KEY')]) {
                    sh """
                    chmod 600 $SSH_KEY
                    scp -i $SSH_KEY -r ${WORKSPACE}/Helpdesk/* akash@${staging_servers}:/home/www
                    """
                }
            }
        }
    }
}