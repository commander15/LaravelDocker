#!/bin/sh

# Default behavior if CONTAINER_ROLE isn't set: keep both
if [ -z "$CONTAINER_ROLE" ]; then
    echo "Booting container in combined mode (Queue + Scheduler)..."
    # Let your default supervisor setup load everything
    
elif [ "$CONTAINER_ROLE" = "queue" ]; then
    echo "Booting container in QUEUE ONLY mode..."
    # Delete or move the scheduler config out of the autostart directory
    rm -f $HOME/supervisor/config/schedule.conf 2>/dev/null

elif [ "$CONTAINER_ROLE" = "scheduler" ]; then
    echo "Booting container in SCHEDULER ONLY mode..."
    # Delete or move the queue worker configs out of the autostart directory
    rm -f $HOME/supervisor/config/queue.conf 2>/dev/null
fi
