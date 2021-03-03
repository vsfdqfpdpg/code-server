from mkdocs.plugins import BasePlugin

class YourPlugin(BasePlugin):
    def __init__(self):
        self.enabled = True
        self.total_time = 0

    def on_page_markdown(self, markdown, page, config, files):
        return markdown