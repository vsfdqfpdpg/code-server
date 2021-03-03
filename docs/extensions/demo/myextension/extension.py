from markdown.extensions import Extension
from markdown.inlinepatterns import SimpleTagPattern

DEL_RE = r'(--)(.*?)--'

class MyExtension(Extension):
    def extendMarkdown(self, md):
        # Create the del pattern
        del_tag = SimpleTagPattern(DEL_RE, 'del')
        # Insert del pattern into markdown parser
        md.inlinePatterns.add('del', del_tag, '>not_strong')