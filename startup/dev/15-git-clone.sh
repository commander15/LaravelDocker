#!/usr/bin/env sh

# Create user's .ssh directory and set permissions
mkdir -p "$HOME/.ssh"
chmod 700 "$HOME/.ssh"

# If GIT_SSH_KEY is defined, store it
if [ -n "$GIT_SSH_KEY" ]; then
    echo "$GIT_SSH_KEY" > "$HOME/.ssh/id_rsa"
    chmod 600 "$HOME/.ssh/id_rsa"
    # Disable strict host key checking so cloning doesn't hang prompts
    echo "StrictHostKeyChecking no" >> "$HOME/.ssh/config"
    chmod 600 "$HOME/.ssh/config"
fi

# If GIT_URL is defined, clone the repository, avoid erasing storage dir on var/www/html
if [ -n "$GIT_URL" ]; then
    # 1. Cleanly clone to a temporary workspace
    rm -rf /var/www/tmp
    git clone --depth 1 "$GIT_URL" /var/www/tmp

    # 2. Ensure destination html and its storage directory exist
    mkdir -p /var/www/html/storage

    # 3. Sync everything EXCEPT the storage directory and the hidden .git metadata
    rsync -av --delete \
        --exclude="storage" \
        --exclude=".git" \
        /var/www/tmp/ /var/www/html/

    # 4. Cleanup the temporary directory
    rm -rf /var/www/tmp
fi