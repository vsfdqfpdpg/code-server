from setuptools import setup, find_packages

setup(
    name='markdown-language-tools',
    version='1.0.0',
    packages=find_packages(),
    install_requires = ['markdown>=3.0'],
    entry_points={
        'markdown.extensions': [
            'marker.del = markdown_language_tools.del:DelTagExtension',
            'marker.fence_link = markdown_language_tools.fence_link:FenceLinkExtension',
        ]
    }
)