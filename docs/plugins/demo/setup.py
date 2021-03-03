from setuptools import setup, find_packages

setup(
    name='mkdocs-your-plugin',
    version='0.1.0',
    description='A MkDocs plugin',
    long_description='',
    keywords='mkdocs',
    url='',
    author='Your Name',
    author_email='your email',
    license='MIT',
    python_requires='>=2.7',
    install_requires=[
        'mkdocs>=1.0.4'
    ],
    classifiers=[
        'Programming Language :: Python :: 3.7'
    ],
    packages=find_packages(),
    entry_points={
        'mkdocs.plugins': [
            'your-plugin = src.plugin:YourPlugin'
        ]
    }
)