from setuptools import setup, find_packages

setup(
    name='myextension',
    version='1.0',
    packages=find_packages(),
    entry_points={
        'markdown.extensions': [
            'mymkextension = myextension.extension:MyExtension',
        ]
    },
    install_requires = ['markdown>=3.0'],
)