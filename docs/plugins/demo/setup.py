from setuptools import setup, find_packages

setup(
    name='mkdocs-language-plugin',
    version='0.1.0',
    packages=find_packages(),
    install_requires=['mkdocs>=1.0.4'],
    entry_points={
        'mkdocs.plugins': [
            'language-plugin = language_plugin.plugin:YourPlugin'
        ]
    }
)