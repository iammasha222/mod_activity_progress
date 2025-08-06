# Totara Module Installation Guide
A Moodle/Totara activity_progress module to show your progress.

This module is designed to be added to your Totara project easily.

## Installation

### 1. Copy the module folder into your Totara project directory:
```
myproject/src/server/blocks/<module-folder>
````
### 2. To prevent the module from being deleted on system restart, add the module folder name to the .rsync-exclude-list file in your project root:

```
/server/blocks/activity_progress
```
This ensures the module folder is excluded from automatic sync deletion.

## Usage

After adding the module and updating the exclude list, restart your Totara environment.

Your module should now be available within Totara.

## Notes
Make sure the module folder name is correctly added to .rsync-exclude-list.

If you update or delete the module, adjust the exclude list accordingly.
