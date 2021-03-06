from mkdocs.plugins import BasePlugin
import re

class YourPlugin(BasePlugin):
    COMMON_IN_BLOCK_RE = r'([\/|#]){2}\s+\[(.*?)\]\((.*)\)'

    def __init__(self):
        self.enabled = True
        self.total_time = 0

    def on_page_markdown(self, markdown, page, config, files):
        return markdown
    
    def on_page_content(self, html,page, config, files):
        search = re.search(self.COMMON_IN_BLOCK_RE, html)
        if search:
            return re.sub(self.COMMON_IN_BLOCK_RE, r'\1\1 <a href="\3" target="_blank" class="comment-link md-button md-button--primary">\2</a>', html)
        return html;