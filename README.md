# DDEV for TYPO3 extensions

This repository provides an example DDEV setup for developing a single TYPO3 CMS extension.

It includes:

- a reusable `.ddev` configuration for extension development
- a minimal TYPO3 extension skeleton
- ready-to-run installation commands for multiple TYPO3 versions
- local documentation rendering via the TYPO3 documentation container

The extension in the repository is only a placeholder. Rename and adjust it for your own project before using the setup productively.

Currently supported TYPO3 versions with PHP 8.4:

- TYPO3 13.4 LTS
- TYPO3 14.3 LTS

In TYPO3 14.3, the Camino theme is installed as the default distribution.

If you need older TYPO3 versions, use one of these tags:

- [TYPO3 CMS 11.5, 12.4 and 13.4 LTS with PHP 8.2](https://github.com/a-r-m-i-n/ddev-for-typo3-extensions/tree/v12-support)
- [TYPO3 CMS 9.5 and 10.4 LTS](https://github.com/a-r-m-i-n/ddev-for-typo3-extensions/tree/v9-support)
- [TYPO3 CMS 8.7 LTS](https://github.com/a-r-m-i-n/ddev-for-typo3-extensions/tree/v8-support)

## Setup

1. Copy the complete `.ddev` directory into the root of your extension project.
2. Replace the placeholder values in all files inside `.ddev`:
   - replace `my_ext` with your TYPO3 extension key
   - replace `my-ext` with your DDEV site name
3. Update the package name `vendor/my-ext` in:
   - `composer.json`
   - `.ddev/docker-compose.web.yaml` in the `PACKAGE_NAME` environment variable
4. Adjust the PSR-4 autoload configuration in `composer.json` to match your vendor and extension namespace.

After the rename, these files will have usually been changed:

- `.ddev/apache/apache-site.conf`
- `.ddev/config.yaml`
- `.ddev/docker-compose.web.yaml`
- `.ddev/web-build/Dockerfile`
- `composer.json`

Once that is done, commit the result to your version control system so collaborators can start the environment without repeating the setup work.

## Usage

### Requirements

The following software must be installed on the host machine:

- Docker
- Docker Compose
- DDEV

An internet connection is required during the initial setup to download images and Composer packages. After that, the environment can also be used offline in most cases.

### Start DDEV

With the `.ddev` directory in place, start the project with:

```bash
ddev start
```

This starts the containers, but it does not install any TYPO3 instance automatically.

### Install TYPO3 environments

The setup provides dedicated DDEV commands for provisioning separate TYPO3 instances:

```bash
ddev install-v13
ddev install-v14
```

To install both environments in one step, run:

```bash
ddev install-all
```

Each installation is created in its own directory inside the web container:

- `v13` for TYPO3 13.4
- `v14` for TYPO3 14.3

After the installation, the overview page is available at:

- https://my-ext.ddev.site/

TYPO3 backend entry points:

- https://v13.my-ext.ddev.site/typo3/
- https://v14.my-ext.ddev.site/typo3/

Rendered local documentation:

- https://docs.my-ext.ddev.site/

To build the documentation first, run:

```bash
ddev docs
```

Replace `my-ext` in the URLs above with your own DDEV site name.

### Credentials

All TYPO3 instances use the same backend and install tool credentials:

- Username: `admin`
- Password: `Password:joh316`

### TYPO3 CLI / typo3_console

You can run TYPO3 CLI commands directly inside each installation:

```bash
ddev exec v13/vendor/bin/typo3
ddev exec v14/vendor/bin/typo3
```

TYPO3 14 also includes `helhum/typo3-console` as part of the installation.

### Render and open documentation

To render the extension documentation locally, run:

```bash
ddev docs
```

To open the rendered result in your browser, run:

```bash
ddev launch-docs
```

### Remove the DDEV project

To delete the DDEV project and its containers, run:

```bash
ddev delete -Oy
```

## Support

### Questions, feature requests, bugs

If you have questions, found a bug, or want to suggest an improvement, please open an issue:

https://github.com/a-r-m-i-n/ddev-for-typo3-extensions/issues

### Known problems

#### Wrong line endings

If you see this error:

> bash: ./install-v14: /bin/bash^M: bad interpreter: No such file or directory

your host system is probably Windows-based and the shell scripts were checked out with `CRLF` line endings instead of `LF`.

On Windows, Git may change line endings automatically unless `git config core.autocrlf false` is set.

### Contribute

If you want to contribute code improvements, fork the repository and open a pull request against the `master` branch.

### Donate

If this project is useful to you, feel free to [donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2DCCULSKFRZFU) to support further development.
